<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Membuat 1 Kaprodi
         User::create([
            'name' => 'Kaprodi',
            'email' => 'kaprodi@simpema.com',
            'password' => Hash::make('password123'),
            'role' => 'kaprodi'
        ]);

        // Membuat 5 Dosen
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Dosen $i",
                'email' => "dosen$i@simpema.com",
                'password' => Hash::make('password123'),
                'role' => 'dosen'
            ]);
        }

        // Membuat 20 Mahasiswa
        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => "Mahasiswa $i",
                'email' => "mahasiswa$i@simpema.com",
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa'
            ]);
        }
    }
}
