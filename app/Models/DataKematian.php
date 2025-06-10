<?php

// app/Models/DataKematian.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKematian extends Model
{
    protected $fillable = [
        'user_id',
        'nama_ternak',
        'jns_ternak',
        'tgl_lahir',
        'tgl_kematian',
        'penyebab',
        'foto_kegiatan',
        'keterangan',
    ];
}

