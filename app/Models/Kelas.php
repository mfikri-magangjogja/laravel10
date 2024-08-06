<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 't_kelas';
    protected $primarykey = 'id';
    protected $fillable = [
        'nama',
        'kapasitas'
    ];
}
