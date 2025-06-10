<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ternak extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'induk_id',
        'foto_ternak',
        'jns_ternak',
        'umur_ternak',
        'tgl_lahir',
        'kesehatan',
        'status',
        'nama',
        'jns_kelamin',
    ];

    /**
     * Relasi ke User (pemilik ternak)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke induk (jika ternak ini adalah anak)
     */
    public function induk()
    {
        return $this->belongsTo(Ternak::class, 'induk_id');
    }

    /**
     * Relasi ke anak-anak (jika ternak ini adalah induk)
     */
    public function anak()
    {
        return $this->hasMany(Ternak::class, 'induk_id');
    }

    /**
     * Relasi ke kegiatan
     */
    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'id_ternak');
    }
}
