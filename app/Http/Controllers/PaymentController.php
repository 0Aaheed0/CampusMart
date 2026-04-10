<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentItem;
use App\Models\PostProduct;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'required|exists:post_products,id',
        ]);

        $products = PostProduct::whereIn('id', $request->product_ids)
            ->where('status', 'available')
            ->with('user')
            ->get();

        if ($products->isEmpty()) {
            return back()->with('error', 'Some products are no longer available');
        }

        $totalAmount = $products->sum('price');

        return view('products.checkout', compact('products', 'totalAmount'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'required|exists:post_products,id',
            'payment_method' => 'nullable|string',
        ]);

        try {
            $payment = DB::transaction(function () use ($request) {
                $products = PostProduct::whereIn('id', $request->product_ids)
                    ->where('status', 'available')
                    ->with('user')
                    ->lockForUpdate()
                    ->get();

                if ($products->isEmpty()) {
                    throw new \Exception('Some products are no longer available');
                }

                $totalAmount = $products->sum('price');

                // Create payment record
                $payment = Payment::create([
                    'buyer_id' => Auth::id(),
                    'total_amount' => $totalAmount,
                    'payment_status' => 'completed',
                    'payment_method' => $request->payment_method ?? 'card',
                    'notes' => $request->notes ?? null,
                ]);

                // Create payment items
                foreach ($products as $product) {
                    PaymentItem::create([
                        'payment_id' => $payment->id,
                        'product_id' => $product->id,
                        'seller_id' => $product->user_id,
                        'price' => $product->price,
                        'product_name' => $product->product_name,
                        'product_details' => json_encode([
                            'type' => $product->product_type,
                            'condition' => $product->condition,
                            'description' => $product->description,
                        ]),
                    ]);

                    // Update product status to sold
                    $product->update(['status' => 'sold']);

                    // Remove from wishlist if exists
                    Wishlist::where('product_id', $product->id)->delete();
                }

                return $payment;
            });

            return redirect()->route('wishlist.index')
                ->with('success', 'Payment completed successfully! Your order ID is #' . $payment->id);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function buy(Request $request, $productId)
    {
        $product = PostProduct::findOrFail($productId);

        if ($product->status !== 'available') {
            return back()->with('error', 'This product is no longer available');
        }

        // Show checkout page for single product
        return $this->checkout(new Request([
            'product_ids' => [$productId],
        ]));
    }

    public function history()
    {
        $payments = Payment::where('buyer_id', Auth::id())
            ->with(['items.product', 'items.seller'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('products.history', compact('payments'));
    }

    public function sold()
    {
        $soldItems = PaymentItem::where('seller_id', Auth::id())
            ->with(['payment.buyer', 'product'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('products.sold', compact('soldItems'));
    }
}
