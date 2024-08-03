<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestEdit extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_id',
        'mahasiswa_id',
        'field_to_edit',
        'new_value',
        'dosen_wali_id'
    ];
}
