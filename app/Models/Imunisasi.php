<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    protected $table = 'imunisasi';

    protected $fillable = [
        'bayi_balita_id',
        'tanggal',
        'jenis_imunisasi',
        'dosis',
        'keterangan',
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
