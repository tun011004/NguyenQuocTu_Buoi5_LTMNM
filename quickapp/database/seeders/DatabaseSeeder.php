<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Category::factory()
            ->count(5)
            ->hasProducts(8) // mỗi category 8 sản phẩm
            ->create();
    }
}
