<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Mendapatkan semua pengguna dengan role 'mahasiswa'
        $mahasiswaUsers = User::where('role', 'mahasiswa')->get();

        // Mengambil semua kelas
        $kelas = Kelas::all();

        if ($kelas->isEmpty()) {
            throw new \Exception('Kelas tidak ditemukan.');
        }

        if ($mahasiswaUsers->isEmpty()) {
            throw new \Exception('Mahasiswa tidak ditemukan.');
        }

        // Periksa apakah jumlah kelas cukup untuk menampung semua mahasiswa
        $jumlahKelas = $kelas->count();
        $jumlahMahasiswa = $mahasiswaUsers->count();
        if ($jumlahKelas * 10 < $jumlahMahasiswa) {
            $jumlahMahasiswa;
        }

        // Menentukan array kelas yang akan digunakan untuk penyebaran mahasiswa
        foreach ($mahasiswaUsers as $index => $mahasiswaUser) {
            // Menentukan kelas berdasarkan indeks mahasiswa
            $kelasIndex = intval($index / 10); // Cycle through classes with 10 students per class
            $kelas_id = $kelas[$kelasIndex]->kelas_id; // Determine class ID

            Mahasiswa::create([
                'id_user' => $mahasiswaUser->id,
                'kelas_id' => $kelas_id,
                'nama' => $mahasiswaUser->name,
                'nim' => $faker->unique()->numberBetween(100000000, 999999999),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d'),
                'edit' => false,
            ]);
        }
    }
}
