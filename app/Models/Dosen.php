<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 't_dosen';
    protected $primarykey = 'id';
    protected $fillable = [
        'id_user',
        'kelas_id',
        'kode_dosen',
        'nip',
        'nama'
    ];
}
