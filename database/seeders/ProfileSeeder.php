<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function ($user) {
            Profile::create([
                'user_id' => $user->id,
                'bio' => "Biografía de {$user->name}",
                'phone' => '123456789',
                'location' => 'Ciudad Ejemplo',
            ]);
        });
    }
}
