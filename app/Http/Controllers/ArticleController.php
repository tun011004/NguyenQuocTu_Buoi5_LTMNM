<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * GET /articles
     * Danh sách bài viết (có thể đổi sang paginate nếu muốn)
     */
    public function index()
    {
        // Lấy mới nhất trước; đổi ->get() nếu chưa muốn phân trang
        $articles = Article::query()->latest()->paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * GET /articles/create
     * Form tạo mới
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * POST /articles
     * Lưu bài viết vào DB
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:255'],
            'body'  => ['required','string','min:10'],
        ]);

        Article::create($validated);  // nhớ $fillable trong Model

        return redirect()
            ->route('articles.index')
            ->with('success', 'Tạo bài viết thành công.');
    }

    /**
     * GET /articles/{article}
     * Xem chi tiết (dùng implicit binding)
     */
    public function show(Article $article)
    {
        // Tạo view resources/views/articles/show.blade.php để hiển thị đẹp
        // hoặc tạm thời trả về JSON:
        // return response()->json($article);
        return view('articles.show', compact('article'));
    }

    /**
     * GET /articles/{article}/edit
     * Form sửa
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * PUT/PATCH /articles/{article}
     * Cập nhật DB
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:255'],
            'body'  => ['required','string','min:10'],
        ]);

        $article->update($validated);

        return redirect()
            ->route('articles.index')
            ->with('success', "Cập nhật bài viết thành công.");
    }

    /**
     * DELETE /articles/{article}
     * Xoá DB
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('success', "Đã xoá bài viết.");
    }
}
