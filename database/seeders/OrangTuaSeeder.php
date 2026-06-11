<?php

namespace Database\Seeders;

use App\Models\BayiBalita;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrangTuaSeeder extends Seeder
{
    public function run(): void
    {
        $orangTua = User::firstOrCreate(
            ['email' => 'orangtua@posyandu.com'],
            [
                'name' => 'Orang Tua Posyandu',
                'password' => Hash::make('password'),
            ]
        );

        $orangTua->syncRoles(['orang_tua']);

        BayiBalita::updateOrCreate(
            ['nik' => '9201013005260001'],
            [
                'nama' => 'Anak Posyandu',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Buano',
                'tanggal_lahir' => '2023-05-30',
                'berat_lahir' => 3.1,
                'tinggi_lahir' => 49,
                'nama_ayah' => 'Ayah Posyandu',
                'nama_ibu' => 'Ibu Posyandu',
                'no_hp_ortu' => '081234567890',
                'alamat' => 'Desa Buano, Kecamatan Huamual Belakang',
                'user_id' => $orangTua->id,
            ]
        );
    }
}
