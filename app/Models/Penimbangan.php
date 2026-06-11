<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penimbangan extends Model
{
    protected $table = 'penimbangan';

    protected $fillable = [
        'bayi_balita_id',
        'tanggal',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'lingkar_lengan',
        'catatan',
        'user_id'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function bayi()
    {
        return $this->belongsTo(BayiBalita::class, 'bayi_balita_id')->withTrashed();
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
