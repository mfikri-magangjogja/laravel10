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
        Schema::create('t_dosen', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_user')->unique()->constrained('users', 'id');
            $table->foreignId('kelas_id')->nullable()->constrained('t_kelas', 'id')->onDelete('set null');
            $table->integer('kode_dosen');
            $table->integer('nip');
            $table->string('nama', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_dosen');
    }
};
