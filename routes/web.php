<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Models\Article;


Route::get('/', [ArticleController::class, 'index'])->name('home');


// 1. Tham số động {page} + named route
Route::get('/articles/page/{page}', function ($page) {
    return "Trang bài viết số: " . (int) $page;
})->whereNumber('page')->name('articles.page');

// 2. Tham số tùy chọn {slug?} + regex
Route::get('/articles/slug/{slug?}', function ($slug = 'khong-co-slug') {
    return "Slug: " . $slug;
})->where('slug', '[a-z0-9-]+');

// 3. Route group với prefix admin
Route::prefix('admin')->group(function () {
    Route::get('/articles', fn () => 'Quản trị bài viết')
        ->name('admin.articles.index');
});

Route::resource('articles', ArticleController::class);


Route::get('/articles/show/{article}', function (Article $article) {
    // Hiển thị demo chi tiết (mock)
    return "Binding thành công • ID: {$article->id} • Title: {$article->title}";
})->name('articles.binding.show');
