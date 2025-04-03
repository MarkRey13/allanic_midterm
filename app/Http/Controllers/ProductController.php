<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index() {
        return response()->json(Product::all());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);
        return response()->json(Product::create($validated));
    }

    public function show($id) {
        return response()->json(Product::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
        ]);
        $product = Product::findOrFail($id);
        $product->update($validated);
        return response()->json($product);
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
