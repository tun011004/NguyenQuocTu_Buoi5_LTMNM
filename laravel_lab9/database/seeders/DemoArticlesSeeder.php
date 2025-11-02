<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoArticlesSeeder extends Seeder
{
    public function run(): void
    {
        $u = User::first();

        $samples = [
            ['Laravel validation nâng cao', 'Hướng dẫn FormRequest & rule tuỳ chỉnh trong Laravel.'],
            ['Upload hình ảnh với Storage', 'Cách lưu ảnh vào disk public, tạo symlink storage:link.'],
            ['Middleware và Throttle', 'Giới hạn tần suất request và middleware CheckAdmin.'],
            ['Auth với Breeze', 'Cài đặt breeze blade, migrate, routes auth.'],
            ['Policy & Gate', 'Phân quyền theo owner và quyền admin.'],
            ['Localization tiếng Việt', 'Tùy biến resources/lang/vi/validation.php.'],
        ];

        foreach ($samples as [$title,$body]) {
            Article::updateOrCreate(
                ['title' => $title],
                [
                    'user_id' => $u?->id,
                    'body' => $body . "\n\n" . Str::random(60),
                ]
            );
        }
    }
}
