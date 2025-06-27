<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        Comment::factory()->count(15)->create([
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
        ]);
    }
}
