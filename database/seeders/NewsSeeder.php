<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::factory()->count(10)->create([
            'user_id' => User::inRandomOrder()->first()->id,
        ]);
    }
}
