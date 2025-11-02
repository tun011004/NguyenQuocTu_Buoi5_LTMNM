<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Trang chủ: chưa đăng nhập → /login, đã đăng nhập → /articles
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('articles.index')
        : redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    // CRUD cần đăng nhập
    Route::resource('articles', ArticleController::class)->only([
        'create','store','edit','update','destroy'
    ]);

    // Dashboard Breeze
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

// Admin (nếu cần)
Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::resource('articles', ArticleController::class)->names([
        'index'  => 'admin.articles.index',
        'create' => 'admin.articles.create',
        'store'  => 'admin.articles.store',
        'show'   => 'admin.articles.show',
        'edit'   => 'admin.articles.edit',
        'update' => 'admin.articles.update',
        'destroy'=> 'admin.articles.destroy',
    ]);
});

// Public: xem danh sách & chi tiết
Route::resource('articles', ArticleController::class)->only(['index','show']);

// Tuỳ chọn
Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/public-info', fn() => ['status'=>'ok']);
});
Route::post('/webhook/order', fn() => response()->json(['ok'=>true]));

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';

// Local-only debug route to check auth/session from the browser
if (app()->environment('local')) {
    Route::get('/_debug/auth', function () {
        $user = auth()->user();
        return response()->json([
            'auth' => (bool) $user,
            'user' => $user ? ['id'=>$user->id,'email'=>$user->email,'name'=>$user->name,'is_admin'=>$user->is_admin] : null,
            'session_id' => session()->getId(),
        ]);
    });

    // Auto-login demo user (local only) — helpful when browser sessions aren't persisting.
    Route::get('/_debug/login-demo', function () {
        $u = \App\Models\User::where('email', 'demo@huit.edu.vn')->first();
        if (!$u) {
            return response('Demo user not found. Run DemoUserSeeder.', 404);
        }
        auth()->login($u);
        return redirect('/articles/create');
    });

    // Render the create view directly (no auth) with an empty errors bag.
    Route::get('/_debug/view-create', function () {
        $mb = new \Illuminate\Support\MessageBag();
        $vb = new \Illuminate\Support\ViewErrorBag();
        $vb->put('default', $mb);
        return view('articles.create', ['errors' => $vb]);
    });
}
