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

    public function store(ProductStoreRequest $request): Product
    {
        // Create a new product instance
        $product = new Product();

        // Set product attributes from the request data
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

        // Assign a default user_id (in this case, user with ID 5)
        $defaultUserId = 5;
        $product->user_id = $defaultUserId;

        // Save the product to the database
        $product->save();

        // Return the created product
        return $product;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the product by its ID or throw a 404 error if not found
        $product = Product::findOrFail($id);

        // Return the 'products.show' view, passing the product data
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
        // Find the product by its ID
        $product = Product::find($id);

        // If the product doesn't exist, return a 404 response
        if (!$product) {
            return response('',404);
        }
        // Update the product with validated request data
        $product->update($request->validated());

        // Return the updated product
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the product by its ID
        $product = Product::find($id);
        // If the product doesn't exist, return a 404 response with a message
        if (!$product) {
            return response('Product not found',404);
//            return response()->json(['message' => 'Product not found'], 404);
        }
        // Delete the product
        $product->delete();
        // Return a JSON response indicating successful deletion
            return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function getProductsByCategory($category)
    {
        // Retrieve products that belong to the specified category
        $products = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('name', $category);
        })->get();

        // If no products are found for the category, return a 404 response
        if ($products->isEmpty()) {
            return response()->json(['message' => "Category {$category} not found"], 404);
        }
        // Return JSON response with the found products
        return response()->json($products);

    }
    public function search($keyword)
    {
        // Search for products that contain the specified keyword in their name
        $products = Product::where('name', 'like', "%$keyword%")->get();

        // If no products are found for the keyword, return a 404 response
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for the specified keyword.'], 404);
        }
        // Return JSON response with the found products
        return response()->json($products);
    }
}
