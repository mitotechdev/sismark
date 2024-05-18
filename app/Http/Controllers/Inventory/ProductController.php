<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['permission:create-product'], ['only' => ['store']]);
        $this->middleware(['permission:read-product'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:edit-product'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-product'], ['only' => ['destroy']]);
    }
    
    public function index()
    {
        
        $products = Product::latest()->get();
        return view('pages.inventory.product.product-index', [
            'products' => $products,
            'title' => 'Menu Product',
            'titleMenu' => 'menu-inventory',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required|unique:products',
            ]);

            Product::create([
                'code' => $request->code,
                'name' => $request->name_product,
                'packaging' => $request->packaging,
                'unit' => $request->unit,
                'category_product_id' => $request->category_product_id,
                'type_product_id' => $request->type_product_id,
            ]);
            return redirect()->back()->with('success', 'Data produk baru berhasil ditambahkan 🚀');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        try {
            $product->update([
                'code' => $request->code,
                'name' => $request->name_product,
                'packaging' => $request->packaging,
                'unit' => $request->unit,
                'category_product_id' => $request->category_product_id,
                'type_product_id' => $request->type_product_id
            ]);
            return redirect()->back()->with('success', 'Data telah berhasil diperbaharui 🚀');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus 🚀');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
