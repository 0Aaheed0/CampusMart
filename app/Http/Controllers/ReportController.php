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
            'reported_user_id' => 'nullable|exists:users,id',
            'reason' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
        ]);

        // Ensure at least one target is provided
        if ($validated['report_type'] === 'product' && !$validated['product_id']) {
            return back()->with('error', 'Product is required for product reports.');
        }

        if ($validated['report_type'] === 'user' && !$validated['reported_user_id']) {
            return back()->with('error', 'User is required for user reports.');
        }

        // Create the report
        Report::create([
            'user_id' => Auth::id(),
            'product_id' => $validated['product_id'] ?? null,
            'reported_user_id' => $validated['reported_user_id'] ?? null,
            'report_type' => $validated['report_type'],
            'reason' => $validated['reason'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

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
