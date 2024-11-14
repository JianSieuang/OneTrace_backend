<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $products->transform(function ($product) {
            $product->img = asset($product->img);
            return $product;
        });
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);
    
        $data = $request->only(['name', 'price', 'description']);
    
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('public/images');
            $data['img'] = str_replace('public/', 'storage/', $path);
        }
    
        $product = Product::create($data);
    
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png|max:2048', 
        ]);

        $data = $request->only(['name', 'price', 'description']);

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('public/images');
            $data['img'] = str_replace('public/', 'storage/', $path);
        }

        $product->update($data);

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
