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
            $table->id('request_id');
            $table->foreignId('mahasiswa_id')->constrained('t_mahasiswa', 'mahasiswa_id');
            $table->string('field_to_edit', 50);
            $table->string('new_value', 255);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('dosen_wali_id')->constrained('t_dosen', 'dosen_id');
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
