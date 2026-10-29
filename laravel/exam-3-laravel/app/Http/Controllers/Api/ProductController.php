<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest->get(); //Fetch data lalu diurutkan

        return response()->json(['data' => $products]);
    }

    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['requiered', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['requiered', 'numeric', 'min:0'],
            'stock' => ['required', 'numeric', 'min:0'],
            'image_url' => ['nullable', 'url', 'max:2048'],
        ]);

        $product = Product::create($data)->load('category');

        return response()->json([
            'message' => 'Produk berhasil dibuat!',
            'data' => $product
        ]);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'category_id' => ['sometimes', 'requiered', 'exists:categories,id'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'price' => ['sometimes', 'requiered', 'numeric', 'min:0'],
            'stock' => ['sometimes', 'required', 'numeric', 'min:0'],
            'image_url' => ['sometimes', 'nullable', 'url', 'max:2048'],
        ]);

        $product->update($data);
        $product->load('category');

        return response()->json([
            'message' => 'Produk berhasil diperbaharui',
            'data' => $product,
        ]);
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus',
        ]);
    }
}
