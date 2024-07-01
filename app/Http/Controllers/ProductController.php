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
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = uniqid() . '_' . trim($image->getClientOriginalName());
            $image->storeAs('public/products', $name);

            return response()->json([
                'name' => $name,
                'original_name' => $image->getClientOriginalName(),
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:products',
            'price' => 'required|numeric',
            'stok' => 'required|numeric',
            'desc' => 'required',
            'category_id' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->stok = $request->stok;
        $product->desc = $request->desc;
        $product->category_id = $request->category_id;
        $product->save();

        // Upload multiple images
        foreach ($request->input('images', []) as $file) {
            $productImage = new Image();
            $productImage->product_id = $product->id;
            $productImage->image_product = $file;
            $productImage->save();
        }

        Alert::success('Success', 'Product added successfully');
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
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $product->load('image');
        return view('admin.product.edit', compact('categories', 'product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'stok' => 'required|numeric',
            'desc' => 'required',
            'category_id' => 'required',
        ]);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->stok = $request->stok;
        $product->desc = $request->desc;
        $product->category_id = $request->category_id;
        $product->save();

        // Handle image uploads
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());
            Storage::delete('public/products/' . $product->image);
            $product->image = $image->hashName();
        }

        // Upload multiple images
        foreach ($request->input('images', []) as $file) {
            $productImage = new Image();
            $productImage->product_id = $product->id;
            $productImage->image_product = $file;
            $productImage->save();
        }

        Alert::success('Success', 'Product updated successfully');
        return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan produk berdasarkan id
        $product = Product::findOrFail($id);

        // Hapus gambar utama jika ada
        if ($product->image) {
            Storage::delete('public/products/' . $product->image);
        }

        // Hapus gambar-gambar terkait
        $productImages = Image::where('product_id', $product->id)->get();
        foreach ($productImages as $image) {
            Storage::delete('public/products/' . $image->image_product);
            $image->delete();
        }

        // Hapus produk
        $product->delete();

        Alert::success('Success', 'Product deleted successfully');
        return redirect()->route('product.index');
    }

}
