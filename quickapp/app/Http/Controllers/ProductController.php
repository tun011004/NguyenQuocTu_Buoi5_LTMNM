<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /products
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    // GET /products/create
    public function create()
    {
        $categories = Category::orderBy('name')->pluck('name','id');
        return view('products.create', compact('categories'));
    }

    // POST /products
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'price'       => ['required','numeric','min:0'],
            'category_id' => ['required','exists:categories,id'],
        ]);

        Product::create($data);
        return redirect()->route('products.index')->with('success','Tạo sản phẩm thành công');
    }

    // GET /products/{product}/edit
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->pluck('name','id');
        return view('products.edit', compact('product','categories'));
    }

    // PUT /products/{product}
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'price'       => ['required','numeric','min:0'],
            'category_id' => ['required','exists:categories,id'],
        ]);

        $product->update($data);
        return redirect()->route('products.index')->with('success','Cập nhật sản phẩm thành công');
    }

    // DELETE /products/{product}
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success','Đã xóa sản phẩm');
    }
}
