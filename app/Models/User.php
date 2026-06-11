<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    private const ROLE_DASHBOARDS = [
        'kader' => 'admin.dashboard',
        'bidan_desa' => 'bidan.dashboard',
        'orang_tua' => 'orangtua.dashboard',
    ];

    private const SYSTEM_EMAIL_ROLES = [
        'admin@posyandu.com' => 'kader',
        'bidan@posyandu.com' => 'bidan_desa',
        'orangtua@posyandu.com' => 'orang_tua',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function primaryRoleName(): ?string
    {
        foreach (array_keys(self::ROLE_DASHBOARDS) as $roleName) {
            if ($this->hasRole($roleName)) {
                return $roleName;
            }
        }

        return null;
    }

    public function dashboardRouteName(): ?string
    {
        $roleName = $this->primaryRoleName();

        return $roleName !== null
            ? self::ROLE_DASHBOARDS[$roleName]
            : null;
    }

    public function normalizeSystemRole(): void
    {
        $expectedRole = self::SYSTEM_EMAIL_ROLES[strtolower($this->email)] ?? null;

        if ($expectedRole === null) {
            return;
        }

        if ($this->getRoleNames()->all() !== [$expectedRole]) {
            $this->syncRoles([$expectedRole]);
            $this->unsetRelation('roles');
        }
    }

    public function anak()
    {
        return $this->hasMany(BayiBalita::class);
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalPosyandu::class, 'created_by');
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
