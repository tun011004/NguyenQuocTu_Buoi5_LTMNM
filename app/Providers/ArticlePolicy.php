<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function create(User $user): bool
    {
        return (bool) $user; // chỉ cần đăng nhập
    }

    public function update(User $user, Article $article): bool
    {
        return ($user->is_admin ?? false) || $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article): bool
    {
        return ($user->is_admin ?? false) || $user->id === $article->user_id;
    }
}
