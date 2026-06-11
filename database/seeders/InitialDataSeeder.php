<?php

namespace Database\Seeders;

use App\Models\BayiBalita;
use App\Models\Imunisasi;
use App\Models\JadwalPosyandu;
use App\Models\Penimbangan;
use App\Models\User;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        $bidan = User::where('email', 'bidan@posyandu.com')->first();
        $orangTua = User::where('email', 'orangtua@posyandu.com')->first();

        if (! $bidan || ! $orangTua) {
            return;
        }

        $balitaData = [
            [
                'nik' => '9201013005260001',
                'nama' => 'Anak Posyandu',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Buano',
                'tanggal_lahir' => '2023-05-30',
                'berat_lahir' => 3.10,
                'tinggi_lahir' => 49.00,
                'nama_ayah' => 'Ayah Posyandu',
                'nama_ibu' => 'Ibu Posyandu',
                'no_hp_ortu' => '081234567890',
                'alamat' => 'Desa Buano, Kecamatan Huamual Belakang',
            ],
            [
                'nik' => '9201013005260002',
                'nama' => 'Alya Rahma',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Buano Utara',
                'tanggal_lahir' => '2022-11-14',
                'berat_lahir' => 2.90,
                'tinggi_lahir' => 48.00,
                'nama_ayah' => 'Rifki Rahman',
                'nama_ibu' => 'Siska Rahma',
                'no_hp_ortu' => '081234567891',
                'alamat' => 'Dusun Melati, Desa Buano Utara',
            ],
            [
                'nik' => '9201013005260003',
                'nama' => 'Fikri Maulana',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Buano Selatan',
                'tanggal_lahir' => '2021-08-02',
                'berat_lahir' => 3.20,
                'tinggi_lahir' => 50.00,
                'nama_ayah' => 'Arman Maulana',
                'nama_ibu' => 'Nia Fitri',
                'no_hp_ortu' => '081234567892',
                'alamat' => 'Dusun Kenanga, Desa Buano Selatan',
            ],
            [
                'nik' => '9201013005260004',
                'nama' => 'Nabila Putri',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Buano',
                'tanggal_lahir' => '2020-12-21',
                'berat_lahir' => 3.00,
                'tinggi_lahir' => 49.50,
                'nama_ayah' => 'Hendra Putra',
                'nama_ibu' => 'Mira Putri',
                'no_hp_ortu' => '081234567893',
                'alamat' => 'Dusun Cempaka, Desa Buano',
            ],
            [
                'nik' => '9201013005260005',
                'nama' => 'Raka Pratama',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Buano Timur',
                'tanggal_lahir' => '2023-01-18',
                'berat_lahir' => 3.15,
                'tinggi_lahir' => 49.20,
                'nama_ayah' => 'Doni Pratama',
                'nama_ibu' => 'Lina Sari',
                'no_hp_ortu' => '081234567894',
                'alamat' => 'Dusun Anggrek, Desa Buano Timur',
            ],
            [
                'nik' => '9201013005260006',
                'nama' => 'Zahra Aulia',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Buano Barat',
                'tanggal_lahir' => '2022-06-10',
                'berat_lahir' => 2.85,
                'tinggi_lahir' => 47.80,
                'nama_ayah' => 'Aldi Aulia',
                'nama_ibu' => 'Rani Aulia',
                'no_hp_ortu' => '081234567895',
                'alamat' => 'Dusun Mawar, Desa Buano Barat',
            ],
        ];

        $balitas = collect($balitaData)->map(function (array $data) use ($orangTua) {
            return BayiBalita::updateOrCreate(
                ['nik' => $data['nik']],
                array_merge($data, ['user_id' => $orangTua->id])
            );
        });

        $penimbanganData = [
            ['nik' => '9201013005260001', 'tanggal' => '2026-01-10', 'berat_badan' => 10.40, 'tinggi_badan' => 79.50, 'lingkar_kepala' => 46.00, 'lingkar_lengan' => 14.20, 'catatan' => 'Perkembangan baik.'],
            ['nik' => '9201013005260001', 'tanggal' => '2026-03-10', 'berat_badan' => 10.90, 'tinggi_badan' => 81.00, 'lingkar_kepala' => 46.30, 'lingkar_lengan' => 14.40, 'catatan' => 'Nafsu makan baik.'],
            ['nik' => '9201013005260002', 'tanggal' => '2026-01-12', 'berat_badan' => 11.10, 'tinggi_badan' => 82.00, 'lingkar_kepala' => 46.50, 'lingkar_lengan' => 14.60, 'catatan' => 'Aktif dan sehat.'],
            ['nik' => '9201013005260002', 'tanggal' => '2026-04-12', 'berat_badan' => 11.50, 'tinggi_badan' => 83.40, 'lingkar_kepala' => 46.80, 'lingkar_lengan' => 14.70, 'catatan' => 'Disarankan lanjut pola makan seimbang.'],
            ['nik' => '9201013005260003', 'tanggal' => '2026-02-08', 'berat_badan' => 13.60, 'tinggi_badan' => 91.20, 'lingkar_kepala' => 48.20, 'lingkar_lengan' => 15.30, 'catatan' => 'Pertumbuhan stabil.'],
            ['nik' => '9201013005260003', 'tanggal' => '2026-05-08', 'berat_badan' => 14.00, 'tinggi_badan' => 92.50, 'lingkar_kepala' => 48.50, 'lingkar_lengan' => 15.60, 'catatan' => 'Sangat aktif saat pemeriksaan.'],
            ['nik' => '9201013005260004', 'tanggal' => '2026-02-15', 'berat_badan' => 12.80, 'tinggi_badan' => 89.70, 'lingkar_kepala' => 47.70, 'lingkar_lengan' => 15.10, 'catatan' => 'Kondisi umum baik.'],
            ['nik' => '9201013005260005', 'tanggal' => '2026-03-03', 'berat_badan' => 9.80, 'tinggi_badan' => 76.40, 'lingkar_kepala' => 45.60, 'lingkar_lengan' => 13.90, 'catatan' => 'Perlu pemantauan pola tidur.'],
            ['nik' => '9201013005260006', 'tanggal' => '2026-04-20', 'berat_badan' => 10.70, 'tinggi_badan' => 80.80, 'lingkar_kepala' => 46.10, 'lingkar_lengan' => 14.30, 'catatan' => 'Tumbuh kembang sesuai usia.'],
        ];

        foreach ($penimbanganData as $data) {
            $balita = $balitas->firstWhere('nik', $data['nik']);

            if (! $balita) {
                continue;
            }

            Penimbangan::updateOrCreate(
                [
                    'bayi_balita_id' => $balita->id,
                    'tanggal' => $data['tanggal'],
                ],
                [
                    'berat_badan' => $data['berat_badan'],
                    'tinggi_badan' => $data['tinggi_badan'],
                    'lingkar_kepala' => $data['lingkar_kepala'],
                    'lingkar_lengan' => $data['lingkar_lengan'],
                    'catatan' => $data['catatan'],
                    'user_id' => $bidan->id,
                ]
            );
        }

        $imunisasiData = [
            ['nik' => '9201013005260001', 'tanggal' => '2026-01-10', 'jenis_imunisasi' => 'Campak', 'dosis' => 'Dosis 1', 'keterangan' => 'Tidak ada keluhan setelah imunisasi.'],
            ['nik' => '9201013005260001', 'tanggal' => '2026-04-10', 'jenis_imunisasi' => 'Vitamin A', 'dosis' => 'Dosis 1', 'keterangan' => 'Pemberian vitamin rutin.'],
            ['nik' => '9201013005260002', 'tanggal' => '2026-01-12', 'jenis_imunisasi' => 'DPT', 'dosis' => 'Booster', 'keterangan' => 'Observasi 15 menit, aman.'],
            ['nik' => '9201013005260003', 'tanggal' => '2026-02-08', 'jenis_imunisasi' => 'Polio', 'dosis' => 'Dosis 4', 'keterangan' => 'Layanan berjalan lancar.'],
            ['nik' => '9201013005260003', 'tanggal' => '2026-05-08', 'jenis_imunisasi' => 'Campak', 'dosis' => 'Booster', 'keterangan' => 'Tidak ada reaksi lanjutan.'],
            ['nik' => '9201013005260004', 'tanggal' => '2026-02-15', 'jenis_imunisasi' => 'Hepatitis B', 'dosis' => 'Dosis 3', 'keterangan' => 'Anak dalam kondisi sehat.'],
            ['nik' => '9201013005260005', 'tanggal' => '2026-03-03', 'jenis_imunisasi' => 'BCG', 'dosis' => 'Dosis 1', 'keterangan' => 'Disertai edukasi kepada orang tua.'],
            ['nik' => '9201013005260006', 'tanggal' => '2026-04-20', 'jenis_imunisasi' => 'Polio', 'dosis' => 'Booster', 'keterangan' => 'Jadwal imunisasi lengkap.'],
        ];

        foreach ($imunisasiData as $data) {
            $balita = $balitas->firstWhere('nik', $data['nik']);

            if (! $balita) {
                continue;
            }

            Imunisasi::updateOrCreate(
                [
                    'bayi_balita_id' => $balita->id,
                    'tanggal' => $data['tanggal'],
                    'jenis_imunisasi' => $data['jenis_imunisasi'],
                ],
                [
                    'dosis' => $data['dosis'],
                    'keterangan' => $data['keterangan'],
                    'user_id' => $bidan->id,
                ]
            );
        }

        $jadwalData = [
            ['judul' => 'Posyandu Mawar I', 'tanggal' => '2026-06-03', 'jam' => '08:00:00', 'lokasi' => 'Balai Desa Buano', 'keterangan' => 'Layanan penimbangan dan imunisasi rutin.'],
            ['judul' => 'Posyandu Kenanga', 'tanggal' => '2026-06-10', 'jam' => '08:30:00', 'lokasi' => 'PAUD Kenanga', 'keterangan' => 'Pemeriksaan balita dan konsultasi gizi.'],
            ['judul' => 'Posyandu Anggrek', 'tanggal' => '2026-06-17', 'jam' => '09:00:00', 'lokasi' => 'Pos Pelayanan Anggrek', 'keterangan' => 'Pelayanan khusus jadwal imunisasi lanjutan.'],
            ['judul' => 'Posyandu Cempaka', 'tanggal' => '2026-06-24', 'jam' => '08:00:00', 'lokasi' => 'Rumah Kader Cempaka', 'keterangan' => 'Layanan timbang dan pencatatan tumbuh kembang.'],
            ['judul' => 'Posyandu Melati', 'tanggal' => '2026-07-01', 'jam' => '08:15:00', 'lokasi' => 'Balai RT Melati', 'keterangan' => 'Pemeriksaan rutin awal bulan.'],
            ['judul' => 'Posyandu Terpadu Buano', 'tanggal' => '2026-07-08', 'jam' => '08:00:00', 'lokasi' => 'Puskesmas Pembantu Buano', 'keterangan' => 'Pelayanan lengkap ibu dan anak.'],
        ];

        foreach ($jadwalData as $data) {
            JadwalPosyandu::updateOrCreate(
                [
                    'judul' => $data['judul'],
                    'tanggal' => $data['tanggal'],
                ],
                [
                    'jam' => $data['jam'],
                    'lokasi' => $data['lokasi'],
                    'keterangan' => $data['keterangan'],
                    'created_by' => $bidan->id,
                ]
            );
        }
    }
}
