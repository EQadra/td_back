<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->warn('No hay productos para calificar. Seeder cancelado.');
            return;
        }

        $users->each(function ($user) use ($products) {
            // Tomar un producto aleatorio que aún no haya sido calificado por este usuario
            $product = $products->random();

            Rating::firstOrCreate(
                ['user_id' => $user->id, 'product_id' => $product->id],
                [
                    'score' => rand(1, 5),
                    'comment' => fake()->sentence(),
                ]
            );
        });
    }
}
