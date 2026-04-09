<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PostProduct;

class AdminController extends Controller
{
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
}
