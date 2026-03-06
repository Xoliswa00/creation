<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {
        $products = auth()->user()->currentCompany->products()->latest()->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'billing_type' => 'required|in:once,recurring',
            'vat_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        $product = auth()->user()->currentCompany->products()->create($validated);
        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->only(['name','description','price','billing_type','vat_rate']));
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
