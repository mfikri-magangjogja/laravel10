<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;
    protected $table = 't_kaprodi';
    protected $primarykey = 'kaprodi_id';
    protected $fillable = [
        'id',
        'kode_dosen',
        'nip',
        'nama',
    ];
}
