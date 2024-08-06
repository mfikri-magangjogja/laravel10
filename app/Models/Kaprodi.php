<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;
    protected $table = 't_kaprodi';
    protected $primarykey = 'id';
    protected $fillable = [
        'id_user',
        'kode_dosen',
        'nip',
        'nama',
    ];
}
