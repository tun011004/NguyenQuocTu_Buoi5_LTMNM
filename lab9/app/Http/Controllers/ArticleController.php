<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    public function index() {
        $q = request('q');

        $articles = Article::query()
            ->when($q, fn($qq) => $qq->where('title','LIKE','%'.$q.'%'))
            ->latest()
            ->paginate(10);

        // Thống kê
        $stats = [
            'total' => Article::count(),
            'mine'  => auth()->check() ? Article::where('user_id', auth()->id())->count() : 0,
            'week'  => Article::where('created_at','>=', now()->subDays(7))->count(),
        ];

        return view('articles.index', compact('articles','stats','q'));
    }

    public function create() {
        $this->authorize('create', \App\Models\Article::class);
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request) {
        $this->authorize('create', \App\Models\Article::class);
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('articles','public');
        }
        Article::create($data);
        return redirect()->route('articles.index')->with('success','Tạo bài viết thành công');
    }

    public function show(Article $article) {
        $related = $article->relatedByTitle(6);
        return view('articles.show', compact('article','related'));
    }

    public function edit(Article $article) {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, Article $article) {
        $this->authorize('update', $article);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if (!empty($article->image_path) && Storage::disk('public')->exists($article->image_path)) {
                Storage::disk('public')->delete($article->image_path);
            }
            $data['image_path'] = $request->file('image')->store('articles','public');
        }
        $article->update($data);
        return redirect()->route('articles.show', $article)->with('success','Cập nhật thành công');
    }

    public function destroy(Article $article) {
        $this->authorize('delete', $article);
        if (!empty($article->image_path) && Storage::disk('public')->exists($article->image_path)) {
            Storage::disk('public')->delete($article->image_path);
        }
        $article->delete();
        return redirect()->route('articles.index')->with('success','Đã xoá bài viết');
    }
}
