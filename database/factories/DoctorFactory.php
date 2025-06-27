<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition(): array
    {
        $specializations = [
            'Cardiología', 'Pediatría', 'Neurología', 'Ginecología', 'Dermatología',
            'Oncología', 'Psiquiatría', 'Oftalmología', 'Ortopedia', 'Medicina Interna'
        ];

        return [
            'user_id' => User::factory(), // Crea un usuario nuevo o usá un existente en un seeder
            'specialization' => $this->faker->randomElement($specializations),
            'license_number' => 'M-' . $this->faker->unique()->numerify('#####'), // Matrícula simulada
        ];
    }
}
