<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kaprodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KaprodiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Mendapatkan pengguna dengan peran 'kaprodi'
        $kaprodiUser = User::where('role', 'kaprodi')->first();

        // Memastikan ada pengguna dengan peran 'kaprodi'
        if ($kaprodiUser) {
            Kaprodi::create([
                'id_user' => $kaprodiUser->id,
                'kode_dosen' => $faker->unique()->numberBetween(1000, 9999),
                'nip' => $faker->unique()->numberBetween(100000000, 999999999),
                'nama' => $kaprodiUser->name,
            ]);
        } else {
            throw new \Exception('Pengguna dengan peran kaprodi tidak ditemukan.');
        }
    }
}
