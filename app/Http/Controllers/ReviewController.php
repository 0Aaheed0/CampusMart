<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get user's purchased products from payment history
        $purchasedProducts = Payment::where('buyer_id', Auth::id())
            ->with('items.product')
            ->orderByDesc('created_at')
            ->get()
            ->flatMap(function ($payment) {
                return $payment->items->map(function ($item) {
                    return $item->product;
                });
            })
            ->filter() // Remove null values
            ->unique('id')
            ->values();

        return view('reviews.index', compact('purchasedProducts'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:post_products,id',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}



