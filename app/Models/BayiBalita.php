<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BayiBalita extends Model
{
    use SoftDeletes;

    protected $table = 'bayi_balita';

    protected $fillable = [

        'nik',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'berat_lahir',
        'tinggi_lahir',
        'foto',

        'nama_ayah',
        'nama_ibu',
        'no_hp_ortu',
        'alamat',

        'user_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function orangTua()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penimbangan()
    {
        return $this->hasMany(Penimbangan::class);
    }

    public function imunisasi()
    {
        return $this->hasMany(Imunisasi::class);
    }
}
