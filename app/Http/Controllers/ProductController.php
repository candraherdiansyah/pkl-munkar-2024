<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::latest()->get();
        confirmDelete('Delete', 'Are You Sure?');
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads/products');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->stok = $request->stok;
        $product->price = $request->price;
        $product->desc = $request->desc;
        $product->category_id = $request->category_id;
        $product->save();

        // upload multiple image
        foreach ($request->input('images', []) as $file) {
            $productImage = new Image();
            $productImage->product_id = $product->id;
            $productImage->image_product = $file;
            $productImage->save();
        }

        Alert::success('Success', 'Add Data Successfully');
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.show', compact('product'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Alert::success('Success', 'Add Data Successfully');
        return redirect()->route('product.index');
    }
}
