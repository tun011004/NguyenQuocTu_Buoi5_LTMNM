<?php

namespace App\Providers;

use App\Models\Article;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // (tuỳ chọn) admin pass mọi policy nếu có cột is_admin
        Gate::before(function ($user, $ability) {
            return ($user->is_admin ?? false) ? true : null;
        });
    }
}
