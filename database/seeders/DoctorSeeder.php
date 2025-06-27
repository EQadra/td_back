<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurate de tener usuarios creados
        $users = User::inRandomOrder()->take(10)->get();

        foreach ($users as $user) {
            Doctor::create([
                'user_id' => $user->id,
                'specialization' => fake()->randomElement([
                    'Cardiología', 'Pediatría', 'Neurología', 'Ginecología', 'Dermatología',
                    'Oncología', 'Psiquiatría', 'Oftalmología', 'Ortopedia', 'Medicina Interna'
                ]),
                'license_number' => 'M-' . fake()->unique()->numerify('#####'),
            ]);
        }
    }
}
