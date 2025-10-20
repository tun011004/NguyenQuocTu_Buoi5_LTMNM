<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET /categories
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    // GET /categories/create
    public function create()
    {
        return view('categories.create');
    }

    // POST /categories
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'description' => ['nullable','string'],
        ]);

        Category::create($data);
        return redirect()->route('categories.index')->with('success','Tạo danh mục thành công');
    }

    // GET /categories/{category}/edit
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // PUT /categories/{category}
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'description' => ['nullable','string'],
        ]);

        $category->update($data);
        return redirect()->route('categories.index')->with('success','Cập nhật danh mục thành công');
    }

    // DELETE /categories/{category}
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success','Đã xóa danh mục');
    }
}
