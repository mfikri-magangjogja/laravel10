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
            $table->id('id');
            $table->foreignId('id_user')->unique()->constrained('users', 'id');
            $table->foreignId('kelas_id')->nullable()->constrained('t_kelas', 'id')->onDelete('set null');
            $table->string('nama', 100);
            $table->string('nim');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->boolean('edit')->default(false);
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
