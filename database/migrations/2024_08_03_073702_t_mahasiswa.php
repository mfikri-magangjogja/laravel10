<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_mahasiswa', function (Blueprint $table) {
            $table->id('mahasiswa_id');
            $table->foreignId('id')->unique()->constrained('users', 'id');
            $table->string('nama', 100);
            $table->foreignId('dosen_id')->unique()->constrained('t_dosen', 'dosen_id');
            $table->foreignId('kelas_id')->unique()->constrained('t_kelas', 'kelas_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_mahasiswa');
    }
};
