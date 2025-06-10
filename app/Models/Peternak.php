<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peternak extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'no_telp',
        'alamat',
        'jumlah_ternak',
    ];
}
