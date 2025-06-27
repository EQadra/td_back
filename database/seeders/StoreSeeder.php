<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\User;

class StoreSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('type', 'store')->first();

        if ($user) {
            Store::create([
                'user_id' => $user->id,
                'store_name' => 'Tienda Tech',
                'ruc' => 'RUC-123456',
                'logo' => null,
            ]);
        }
    }
}
