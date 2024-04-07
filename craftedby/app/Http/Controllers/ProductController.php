<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // muestra un formulario
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        //crea el producto en la BD


        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'stock' => 'required|numeric',
            'material' => 'required|string',
            'history_anécdota' => 'required|string',
            'image_path' => 'required|string',
            'description' => 'required|string',
            'categories_id' => 'required|string',
            'shop_id' => 'required|string',
        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->weight = $validatedData['weight'];
        $product->stock = $validatedData['stock'];
        $product->material = $validatedData['material'];
        $product->history_anécdota = $validatedData['history_anécdota'];
        $product->image_path = $validatedData['image_path'];
        $product->description = $validatedData['description'];
        $product->categories_id = $validatedData['categories_id'];
        $product->shop_id = $validatedData['shop_id'];

        # Assign user_id of the authenticated user
//        $product->user_id = Auth::id();

        $defaultUserId = 5;
        $product->user_id = $defaultUserId;

        $product->save();
        $newProductId = $product->id;

        return redirect()->route('products.show', ['product' => $product->id]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'material' => 'nullable|string|max:255',
            'history_anecdote' => 'nullable|string|max:1000',
            'image_path' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'categories_id' => 'required|exists:categories,id',
            'shop_id' => 'required|exists:shops,id',
        ]);

        $product->update($validatedData);

        return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
