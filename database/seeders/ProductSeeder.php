<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Cadena de Oro 18k',
                'metal_type' => 'oro',
                'grams' => 12.5,
                'purity' => 75,
                'price_per_gram' => 260,
                'image_path' => 'products/oro1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anillo de Plata .925',
                'metal_type' => 'plata',
                'grams' => 8.2,
                'purity' => 92.5,
                'price_per_gram' => 20,
                'image_path' => 'products/plata1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pulsera de Oro',
                'metal_type' => 'oro',
                'grams' => 9.7,
                'purity' => 70,
                'price_per_gram' => 255,
                'image_path' => 'products/oro2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dije de Plata',
                'metal_type' => 'plata',
                'grams' => 5.0,
                'purity' => 95,
                'price_per_gram' => 22,
                'image_path' => 'products/plata2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
