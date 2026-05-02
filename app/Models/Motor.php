<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Motor extends Model
{
    use HasFactory;

    public const STATUS_TERSEDIA = 'tersedia';
    public const STATUS_HABIS = 'habis';
    public const STATUS_NONAKTIF = 'nonaktif';

    public const STATUS_OPTIONS = [
        self::STATUS_TERSEDIA,
        self::STATUS_HABIS,
        self::STATUS_NONAKTIF,
    ];

    protected $table = 'motor';

    protected $fillable = [
        'jenis_motor_id',
        'nama_motor',
        'harga_jual',
        'deskripsi_motor',
        'warna',
        'kapasitas_mesin',
        'tahun',
        'foto1',
        'foto2',
        'foto3',
        'stok',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'harga_jual' => 'integer',
            'stok' => 'integer',
            'tahun' => 'integer',
        ];
    }

    public function jenisMotor(): BelongsTo
    {
        return $this->belongsTo(JenisMotor::class);
    }

    public function pengajuanKredit(): HasMany
    {
        return $this->hasMany(PengajuanKredit::class);
    }
}
