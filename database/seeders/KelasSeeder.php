<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'nama' => 'Kelas A', 
            'kapasitas' => 10
        ]);
        Kelas::create ([
            'nama' => 'Kelas B', 
            'kapasitas' => 10
        ]);
    }
}
