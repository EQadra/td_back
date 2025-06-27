<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Association;
use App\Models\User;

class AssociationSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('type', 'association')->first();

        if ($user) {
            Association::create([
                'user_id' => $user->id,
                'name' => 'Asociación Verde',
                'sector' => 'Agricultura',
                'logo' => null,
            ]);
        }
    }
}
