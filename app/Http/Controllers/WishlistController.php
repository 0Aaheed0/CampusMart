<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\PostProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->with('product')
            ->get();
        
        return view('products.wishlist', compact('wishlistItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:post_products,id',
        ]);

        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Product already in wishlist'], 400);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Added to wishlist'], 200);
    }

    public function remove($productId)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return back()->with('success', 'Removed from wishlist');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'exists:post_products,id',
        ]);

        $products = PostProduct::whereIn('id', $request->product_ids)
            ->with('user')
            ->get();

        $totalAmount = $products->sum('price');

        return view('products.checkout', compact('products', 'totalAmount'));
    }

    public function isInWishlist($productId)
    {
        $inWishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['in_wishlist' => $inWishlist]);
    }
}
