<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Crea un user y lo asocia
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph(4),
            'image' => $this->faker->imageUrl(640, 480, 'news', true), // Imagen ficticia
        ];
    }
}
