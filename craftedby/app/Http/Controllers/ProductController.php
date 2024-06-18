<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Info(
 *     title="Craftedby API",
 *     version="1.0.0",
 *     description="The Craftedby API provides comprehensive endpoints to manage products and user. It supports CRUD operations for products. User management features include user registration, authentication, and profile management. Additionally, the API supports product search, category filtering. Designed for scalability and performance, it ensures robust and secure interactions between clients and the eCommerce backend.",
 *      @OA\Contact(
 *          email="nathalie.soto@le-campus-numerique.fr"
 *      ),
 *     @OA\License(
 *          name="MIT License",
 *          url="https://opensource.org/licenses/MIT"
 *      )
 * )
 */

class ProductController extends Controller
{

    /**
     *  Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @OA\Get(
     *     path="/api/products",
     *     summary="Get a list of all products",
     *     tags={"Products"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Product not found")
     * )
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
     *
     * @param  ProductStoreRequest  $request
     * @return Product
     *
     * @OA\Post(
     *     path="/api/products",
     *     summary="Store a new product",
     *     tags={"Products"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              required={"name", "description", "story", "price", "stock", "image", "category"},
     *              @OA\Property(property="name", type="string", example="Product name"),
     *              @OA\Property(property="description", type="string", example="Product description"),
     *              @OA\Property(property="story", type="string", example="Product story"),
     *              @OA\Property(property="price", type="number", format="float", example=10.99),
     *              @OA\Property(property="stock", type="integer", example=10),
     *              @OA\Property(property="image", type="string", example="Product image"),
     *              @OA\Property(property="category", type="string", example="Product category"),
     *              @OA\Property(property="color", type="string", example="Product color"),
     *              @OA\Property(property="material", type="string", example="Product material"),
     *              @OA\Property(property="size", type="string", example="Product size")
     *          )
     *     ),
     *     @OA\Response(response=200, description="Product stored"),
     * )
     */


    public function store(ProductStoreRequest $request)
    {

        // Create a new product instance
        $product = new Product();

        // Set product attributes from the request data
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->weight = $request['weight'];
        $product->stock = $request['stock'];
        $product->material = $request['material'];
        $product->history= $request['history_anécdota'];
        $product->image_path = $request['image_path'];
        $product->description = $request['description'];
        $product->categories_id = $request['categories_id'];
        $product->shop_id = $request['shop_id'];

        # Assign user_id of the authenticated user
        $product->user_id = Auth::id();

        // Assign a default user_id (in this case, user with ID 5)
//        $defaultUserId = 5;
//        $product->user_id = $defaultUserId;

        // Save the product to the database
        $product->save();

        // Return the created product
        return $product;


    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Get a specific product by ID",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product"
     *     ),
     *     @OA\Response(response=200, description="Product found"),
     *     @OA\Response(response=401, description="Product not found")
     * )
     */
    public function show(string $id)
    {
        // Find the product by its ID or throw a 404 error if not found
//        $product = Product::findOrFail($id);

        // Find the product by its ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Check if the current user has permission to view the product
        if (!Auth::user()->hasPermissionTo('products.show')) {
            // If the user doesn't have permission, return an error response
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Return the 'products.show' view, passing the product data
        return $product;


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    public function update(ProductUpdateRequest $request, string $id)
    {
        // Find the product by its ID
        $product = Product::find($id);

        // If the product doesn't exist, return a 404 response
        if (!$product) {
            return response('Product not found',404);
        }

        // Update the product with validated request data
        $product->update($request->validated());

        // Return the updated product
        return $product;
    }


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
