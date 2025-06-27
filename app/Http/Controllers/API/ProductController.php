<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return Product::with(['category', 'user'])->paginate(10);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string'
        ]);
        return Product::create($data);
    }

    public function show(Product $product) {
        return $product->load(['category', 'user', 'comments', 'likes']);
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'image' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id'
        ]);
        $product->update($data);
        return $product;
    }

    public function destroy(Product $product) {
        $product->delete();
        return response()->noContent();
    }
}
