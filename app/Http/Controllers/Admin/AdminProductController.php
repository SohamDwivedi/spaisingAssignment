<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * GET /api/admin/products
     * List all products (paginated)
     */
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(5);

        return response()->json([
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url' => $products->previousPageUrl(),
            ]
        ]);
    }

    /**
     * POST /api/admin/products
     * Create a new product
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'images'      => 'required|string'
        ]);

        // Check for existing product with same name + price
        $existing = Product::where('name', $validated['name'])
            ->where('price', $validated['price'])
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'A product with the same name and price already exists.',
                'existing_product' => $existing,
            ], 200); // HTTP 409 Conflict
        }

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ], 201);
    }

    /**
     * PUT/PATCH /api/admin/products/{id}
     * Update an existing product
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product Not found'], 200);
        }

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric|min:0',
            'stock'       => 'sometimes|required|integer|min:0',
            'images'      => 'sometimes|required|string'
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product,
        ]);
    }

    /**
     * DELETE /api/admin/products/{id}
     * Remove a product
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product Not found'], 200);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
