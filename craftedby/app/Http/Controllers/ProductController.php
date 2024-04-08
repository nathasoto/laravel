<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
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

    public function store(ProductStoreRequest $request)
    {
        //crea el producto en la BD

        $product = new Product();
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->weight = $request['weight'];
        $product->stock = $request['stock'];
        $product->material = $request['material'];
        $product->history_anécdota = $request['history_anécdota'];
        $product->image_path = $request['image_path'];
        $product->description = $request['description'];
        $product->categories_id = $request['categories_id'];
        $product->shop_id = $request['shop_id'];

        # Assign user_id of the authenticated user
//        $product->user_id = Auth::id();

        $defaultUserId = 5;
        $product->user_id = $defaultUserId;

        $product->save();

        return $product;

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
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response('',404);
        }

        $product->update($request->validated());

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product = Product::find($id);
        if (!$product) {
            return response('Product not found',404);
//            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

            return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function getProductsByCategory($category)
    {
        $products = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('name', $category);
        })->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => "Category {$category} not found"], 404);
        }

        return response()->json($products);

    }
    public function search($keyword)
    {
        $products = Product::where('name', 'like', "%$keyword%")->get();
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for the specified keyword.'], 404);
        }
        return response()->json($products);
    }
}
