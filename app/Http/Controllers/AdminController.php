<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PostProduct;

class AdminController extends Controller
{
    // Admin emails with @aust.edu domain for AUST students
    const ADMIN_EMAILS = [
        'yousha.cse.20230104097@aust.edu',
        'aaheed.cse.20230104094@aust.edu',
        'miraz.cse.20230104092@aust.edu',
        'noman.cse.20230104088@aust.edu'
    ];

    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalProducts = PostProduct::count();
        $availableProducts = PostProduct::where('status', 'available')->count();
        $soldProducts = PostProduct::where('status', 'sold')->count();

        $products = PostProduct::with('user')->orderBy('created_at', 'desc')->get();
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalProducts', 
            'availableProducts', 
            'soldProducts',
            'products',
            'users'
        ));
    }

    /**
     * Delete a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot delete an admin account.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    /**
     * Delete a product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduct($id)
    {
        $product = PostProduct::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    /**
     * Display transaction history for all users (buyers and sellers).
     *
     * @return \Illuminate\View\View
     */
    public function history()
    {
        $payments = \App\Models\Payment::with(['buyer', 'items.seller', 'items.product'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.history', compact('payments'));
    }

    /**
     * Display all reviews submitted by users.
     *
     * @return \Illuminate\View\View
     */
    public function reviews()
    {
        $reviews = \App\Models\Review::with(['user', 'product'])
            ->orderByDesc('created_at')
            ->paginate(20);

        $totalReviews = \App\Models\Review::count();
        $averageRating = \App\Models\Review::avg('rating') ?? 0;
        $fiveStarCount = \App\Models\Review::where('rating', 5)->count();
        $todayReviews = \App\Models\Review::whereDate('created_at', today())->count();

        return view('admin.reviews', compact('reviews', 'totalReviews', 'averageRating', 'fiveStarCount', 'todayReviews'));
    }

    /**
     * Display all reports for admin review
     *
     * @return \Illuminate\View\View
     */
    public function reports()
    {
        $reports = \App\Models\Report::with(['user', 'product', 'reportedUser', 'admin'])
            ->orderByDesc('created_at')
            ->paginate(15);

        $totalReports = \App\Models\Report::count();
        $pendingReports = \App\Models\Report::where('status', 'pending')->count();
        $resolvedReports = \App\Models\Report::where('status', 'resolved')->count();
        $todayReports = \App\Models\Report::whereDate('created_at', today())->count();

        return view('admin.reports', compact('reports', 'totalReports', 'pendingReports', 'resolvedReports', 'todayReports'));
    }

    /**
     * Update report status
     */
    public function updateReportStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,resolved,dismissed',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $report = \App\Models\Report::findOrFail($id);
        $report->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $report->admin_notes,
            'admin_id' => Auth::id(),
        ]);

        return back()->with('success', 'Report status updated successfully.');
    }

    /**
     * Display all product posts in the admin panel
     * Uses Eager Loading to avoid N+1 queries
     *
     * @return \Illuminate\View\View
     */
    public function products()
    {
        // Fetch all products with user data using eager loading
        $products = PostProduct::with('user')
            ->orderByDesc('created_at')
            ->paginate(20);

        // Get statistics
        $totalProducts = PostProduct::count();
        $availableProducts = PostProduct::where('status', 'available')->count();
        $soldProducts = PostProduct::where('status', 'sold')->count();
        $todayProducts = PostProduct::whereDate('created_at', today())->count();

        return view('admin.products', compact(
            'products', 
            'totalProducts', 
            'availableProducts', 
            'soldProducts',
            'todayProducts'
        ));
    }
}
