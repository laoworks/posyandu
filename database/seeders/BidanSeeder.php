<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BidanSeeder extends Seeder
{
    public function run(): void
    {
        $bidan = User::firstOrCreate(
            ['email' => 'bidan@posyandu.com'],
            [
                'name' => 'Bidan Posyandu',
                'password' => Hash::make('password'),
            ]
        );

        $bidan->syncRoles(['bidan_desa']);
    }
}
