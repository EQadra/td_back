<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lawyer;
use App\Models\User;

class LawyerSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('type', 'lawyer')->first();

        if ($user) {
            Lawyer::create([
                'user_id' => $user->id,
                'field' => 'Derecho Civil',
                'whatsapp_link' => 'https://wa.me/123456789',
                'bar_number' => 'LAW-5678',
            ]);
        }
    }
}
