<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $dosenUsers = User::where('role', 'dosen')->get();
        $kelas = Kelas::all();

        // Pastikan ada cukup kelas untuk 2 dosen wali
        if ($kelas->count() < 2) {
            throw new \Exception('Jumlah kelas tidak mencukupi untuk dosen wali.');
        }

        // Pastikan ada cukup dosen
        if ($dosenUsers->count() < 5) {
            throw new \Exception('Jumlah dosen tidak mencukupi.');
        }

        // Ambil 5 dosen
        $dosenUsers = $dosenUsers->take(5);

        foreach ($dosenUsers as $index => $dosenUser) {
            // Hanya 2 dosen pertama yang menjadi wali kelas
            $kelas_id = ($index < 2) ? $kelas[$index]->kelas_id : null;

            Dosen::updateOrCreate(
                ['id_user' => $dosenUser->id], // Memastikan tidak ada duplikasi berdasarkan id
                [
                    'kelas_id' => $kelas_id,
                    'kode_dosen' => $faker->unique()->numberBetween(1000, 9999),
                    'nip' => $faker->unique()->numberBetween(100000000, 999999999),
                    'nama' => $dosenUser->name,
                ]
            );
        }
    }
}
