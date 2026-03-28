<?php

namespace App\Http\Controllers;

use App\Models\PostProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = PostProduct::where('status', 'available')
            ->with('user')
            ->orderBy('created_at', 'desc');

        if ($request->has('category') && $request->category != 'All') {
            $query->where('product_type', $request->category);
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = PostProduct::where('status', 'available')
            ->pluck('product_type')
            ->unique()
            ->values();

        return view('products.available', compact('products', 'categories'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|string',
            'used_for' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'contact_number' => 'required|string|max:20',
            'product_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->only([
            'product_name',
            'product_type',
            'price',
            'condition',
            'used_for',
            'description',
            'contact_number'
        ]);

        $data['user_id'] = Auth::id();

        if ($request->hasFile('product_image')) {
            $path = $request->file('product_image')->store('products', 'public');
            $data['product_image'] = $path;
        }

        PostProduct::create($data);

        return redirect()->route('products.available')->with('success', 'Product posted successfully!');
    }
}
