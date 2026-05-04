<?php

namespace App\Models;

use App\Models\Concerns\HasPublicImages;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public const ROLE_USER = 'user';

    public const ROLE_MARKETING = 'marketing';

    public const ROLE_ADMIN = 'admin';

    public const ROLE_CEO = 'ceo';

    public const ROLES = [
        self::ROLE_USER,
        self::ROLE_MARKETING,
        self::ROLE_ADMIN,
        self::ROLE_CEO,
    ];

    /** @use HasFactory<UserFactory> */
    use HasFactory, HasPublicImages, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function pengajuanKredit(): HasMany
    {
        return $this->hasMany(PengajuanKredit::class);
    }

    public function fotoUrl(): ?string
    {
        return $this->publicImageUrl($this->foto);
    }

    public function verifiedAngsuran(): HasMany
    {
        return $this->hasMany(Angsuran::class, 'verified_by');
    }

    public function marketingAssignments(): HasMany
    {
        return $this->hasMany(PengajuanKredit::class, 'marketing_id');
    }

    public function adminAssignments(): HasMany
    {
        return $this->hasMany(PengajuanKredit::class, 'admin_id');
    }
}
