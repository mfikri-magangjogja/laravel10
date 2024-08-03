<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;
    protected $fillable = [
        'kaprodi_id',
        'id',
        'kode_dosen',
        'nip',
        'nama',
    ];
}
