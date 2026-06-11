<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    protected $table = 'jadwal_posyandu';

    protected $fillable = [
        'judul',
        'tanggal',
        'jam',
        'lokasi',
        'keterangan',
        'created_by'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
