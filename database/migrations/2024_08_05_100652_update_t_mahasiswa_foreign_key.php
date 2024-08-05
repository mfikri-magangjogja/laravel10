<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTMahasiswaForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_mahasiswa', function (Blueprint $table) {
            // Drop existing foreign key constraint if any
            $table->dropForeign(['kelas_id']);
            // Alter the 'kelas_id' column to allow null values
            $table->foreignId('kelas_id')->nullable()->change();
            // Add the foreign key constraint with ON DELETE SET NULL
            $table->foreign('kelas_id')->references('kelas_id')->on('t_kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_mahasiswa', function (Blueprint $table) {
            // Drop the foreign key constraint with ON DELETE SET NULL
            $table->dropForeign(['kelas_id']);
            // Revert the 'kelas_id' column to not allow null values
            $table->foreignId('kelas_id')->change();
            // Add the foreign key constraint without ON DELETE SET NULL
            $table->foreign('kelas_id')->references('kelas_id')->on('t_kelas');
        });
    }
}

