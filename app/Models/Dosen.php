<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $fillable = [
        'dosen_id',
        'id',
        'kelas_id',
        'kode_dosen',
        'nip',
        'nama'
    ];
}
