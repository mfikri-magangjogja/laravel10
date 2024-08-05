<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 't_dosen';
    protected $primarykey = 'dosen_id';
    protected $fillable = [
        'id',
        'kelas_id',
        'kode_dosen',
        'nip',
        'nama'
    ];
}
