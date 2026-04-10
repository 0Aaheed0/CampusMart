<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function reports(Request $request)
    {
        $filter = $request->get('filter', 'all');

        // Build query with filtering
        $query = \App\Models\Report::with(['user', 'product', 'reportedUser', 'admin']);

        if ($filter && $filter !== 'all') {
            $query->where('report_type', $filter);
        }

        $reports = $query->orderByDesc('created_at')->paginate(15);

        $totalReports = \App\Models\Report::count();
        $productReports = \App\Models\Report::where('report_type', 'product')->count();
        $userReports = \App\Models\Report::where('report_type', 'user')->count();
        $otherReports = \App\Models\Report::where('report_type', 'other')->count();
        $solvedReports = \App\Models\Report::where('status', 'resolved')->count();
        $unsolvedReports = \App\Models\Report::whereIn('status', ['pending', 'reviewed'])->count();

        return view('admin.reports', compact(
            'reports',
            'filter',
            'totalReports',
            'productReports',
            'userReports',
            'otherReports',
            'solvedReports',
            'unsolvedReports'
        ));
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
     * Toggle report status between pending and resolved (AJAX)
     */
    public function toggleReportStatus(Request $request, $id)
    {
        $report = \App\Models\Report::findOrFail($id);
        
        // Toggle between pending and resolved
        $newStatus = ($report->status === 'pending' || $report->status === 'reviewed') ? 'resolved' : 'pending';
        
        $report->update([
            'status' => $newStatus,
            'admin_id' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'Report status updated to ' . ucfirst($newStatus),
        ]);
    }

    /**
     * Get report details via AJAX for modal
     */
    public function getReportDetails($id)
    {
        $report = \App\Models\Report::with(['user', 'product', 'reportedUser'])
            ->findOrFail($id);

        return response()->json([
            'id' => $report->id,
            'reporter_name' => $report->user->name ?? 'Unknown',
            'reporter_email' => $report->user->email ?? 'N/A',
            'report_type' => ucfirst($report->report_type),
            'reason' => $report->reason,
            'description' => $report->description,
            'status' => ucfirst($report->status),
            'created_at' => $report->created_at->format('M d, Y • H:i A'),
            'product_id' => $report->product_id,
            'product_name' => $report->product?->product_name ?? 'N/A',
            'reported_user_id' => $report->reported_user_id,
            'reported_user_name' => $report->reportedUser?->name ?? 'N/A',
        ]);
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

    /**
     * Display all users in the admin panel
     *
     * @return \Illuminate\View\View
     */
    public function users()
    {
        // Fetch all users with pagination
        $users = User::orderByDesc('created_at')->paginate(20);

        // Get statistics
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        $regularUsers = User::where('role', 'user')->count();
        $todayUsers = User::whereDate('created_at', today())->count();

        return view('admin.users', compact(
            'users',
            'totalUsers',
            'adminUsers',
            'regularUsers',
            'todayUsers'
        ));
    }

    /**
     * Get user profile data via AJAX
     * Returns profile information in JSON format
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserProfile($id)
    {
        $user = User::with('profile')->findOrFail($id);

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'role' => $user->role,
                'avatar' => $user->avatar,
                'created_at' => $user->created_at->format('M d, Y'),
            ],
            'profile' => $user->profile ? [
                'department' => $user->profile->department ?? 'N/A',
                'year' => $user->profile->year ?? 'N/A',
                'semester' => $user->profile->semester ?? 'N/A',
                'student_id' => $user->profile->student_id ?? 'N/A',
                'batch' => $user->profile->batch ?? 'N/A',
                'gender' => $user->profile->gender ?? 'N/A',
                'number' => $user->profile->number ?? 'N/A',
                'profile_picture' => $user->profile->profile_picture ?? null,
            ] : null,
        ]);
    }
}
