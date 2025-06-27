<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            Like::firstOrCreate([
                'user_id' => User::inRandomOrder()->first()->id,
                'product_id' => Product::inRandomOrder()->first()->id,
            ]);
        }
    }
}
