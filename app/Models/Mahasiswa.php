<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'mahasiswa_id',
        'user_id',
        'nama',
        'dosen_wali_id',
        'kelas_id'
    ];
}
