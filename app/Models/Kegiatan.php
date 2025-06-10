<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ternak', 'foto_kegiatan', 'tgl_kegiatan', 'jns_kegiatan', 'keterangan'
    ];

    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'id_ternak');
    }
}
