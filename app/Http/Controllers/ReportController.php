<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\PostProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display the report creation form
     */
    public function create()
    {
        $products = PostProduct::where('status', 'available')->get();
        $users = User::where('id', '!=', Auth::id())->get();
        
        return view('products.report', compact('products', 'users'));
    }

    /**
     * Store a newly created report
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|in:product,user,other',
            'product_id' => 'nullable|exists:post_products,id',
            'reason' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
        ]);

        $reportData = [
            'user_id' => Auth::id(),
            'report_type' => $validated['report_type'],
            'reason' => $validated['reason'],
            'description' => $validated['description'],
            'status' => 'pending',
        ];

        // Handle ID mapping logic based on report type
        if ($validated['report_type'] === 'product') {
            // For product reports, store the product_id directly
            if (!$validated['product_id']) {
                return back()->with('error', 'Product ID is required for product reports.');
            }
            $reportData['product_id'] = $validated['product_id'];
        } elseif ($validated['report_type'] === 'user') {
            // For user reports, user inputs product_id, system looks up owner
            if (!$validated['product_id']) {
                return back()->with('error', 'Product ID is required to identify the user.');
            }
            
            // Find the product and get the owner
            $product = PostProduct::find($validated['product_id']);
            if (!$product) {
                return back()->with('error', 'Product not found.');
            }
            
            // Store both product_id and the owner's user_id as reported_user_id
            $reportData['product_id'] = $validated['product_id'];
            $reportData['reported_user_id'] = $product->user_id;
        }
        // For 'other' type, neither product_id nor reported_user_id is set

        // Create the report
        Report::create($reportData);

        // Return JSON for AJAX requests, redirect for regular form submissions
        if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'message' => 'Report submitted successfully. Our team will review it shortly.'
            ]);
        }

        return back()->with('success', 'Report submitted successfully. Our team will review it shortly.');
    }

    /**
     * Show user's own reports
     */
    public function myReports()
    {
        $reports = Report::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('products.my-reports', compact('reports'));
    }
}
