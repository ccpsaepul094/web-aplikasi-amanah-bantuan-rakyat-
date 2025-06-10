<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BagiHasil extends Model
{
    protected $fillable = [
        'id_kegiatan',
        'user_id',
        'total_tagihan',
        'jumlah_dibayar',
        'status',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
