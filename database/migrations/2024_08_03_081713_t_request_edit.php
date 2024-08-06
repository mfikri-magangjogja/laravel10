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
        Schema::create('t_request_edit', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('mahasiswa_id')->constrained('t_mahasiswa', 'id');
            $table->foreignId('kelas_id')->unique()->constrained('t_kelas', 'id');
            $table->string('keterangan', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_request_edit');
    }
};
