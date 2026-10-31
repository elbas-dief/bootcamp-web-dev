<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductResource::collection(products::with('category')->latest()->get()); //Fetch data lalu diurutkan

        return response()->json(['data' => $products]);
    }

    public function show(string $id)
    {
        $product = new ProductResource(products::with('category')->findOrFail($id));

        return response()->json(['data' => $product]);
    }

    public function store(StoreProductRequest $request)
    {
        // Dipindah ke StoreProductRequest (Validasi terpisah)
        // $data = $request->validate([
        //     'category_id' => ['requiered', 'exists:categories,id'],
        //     'name' => ['required', 'string', 'max:255'],
        //     'description' => ['nullable', 'string'],
        //     'price' => ['requiered', 'numeric', 'min:0'],
        //     'stock' => ['required', 'numeric', 'min:0'],
        //     'image_url' => ['nullable', 'url', 'max:2048'],
        // ]);

        $product = products::create($request->validated())->load('category');

        return response()->json([
            'message' => 'Produk berhasil dibuat!',
            'data' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = products::findOrFail($id);

        // Dipindah ke UpdateProductRequest (Validasi terpisah)
        // $data = $request->validate([
        //     'category_id' => ['sometimes', 'requiered', 'exists:categories,id'],
        //     'name' => ['sometimes', 'required', 'string', 'max:255'],
        //     'description' => ['sometimes', 'nullable', 'string'],
        //     'price' => ['sometimes', 'requiered', 'numeric', 'min:0'],
        //     'stock' => ['sometimes', 'required', 'numeric', 'min:0'],
        //     'image_url' => ['sometimes', 'nullable', 'url', 'max:2048'],
        // ]);

        $product->update($request->validated());
        $product->load('category');

        return response()->json([
            'message' => 'Produk berhasil diperbaharui',
            'data' => new ProductResource($product),
        ]);
    }

    public function destroy(string $id)
    {
        $product = products::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus',
        ]);
    }
}
