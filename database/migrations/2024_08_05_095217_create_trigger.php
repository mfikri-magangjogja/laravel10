<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        DB::unprepared('CREATE TRIGGER after_kelas_delete AFTER DELETE ON `t_kelas` FOR EACH ROW
            BEGIN
                UPDATE t_mahasiswa
                SET kelas_id = NULL
                WHERE kelas_id = OLD.kelas_id;
            END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_User_Default_Member_Role`');
    }
};
