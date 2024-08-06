<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 't_mahasiswa';
    protected $primarykey = 'id';
    protected $fillable = [
        'id_user',
        'kelas_id',
        'nama',
        'nim',
        'tempat_lahir',
        'tanggal_lahir',
        'edit'
    ];
}
