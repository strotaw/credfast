<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kredit extends Model
{
    use HasFactory;

    public const STATUS_AKTIF = 'aktif';
    public const STATUS_MACET = 'macet';
    public const STATUS_LUNAS = 'lunas';
    public const STATUS_DIBATALKAN = 'dibatalkan';

    public const STATUS_OPTIONS = [
        self::STATUS_AKTIF,
        self::STATUS_MACET,
        self::STATUS_LUNAS,
        self::STATUS_DIBATALKAN,
    ];

    protected $table = 'kredit';

    protected $fillable = [
        'pengajuan_kredit_id',
        'metode_bayar_id',
        'no_kontrak',
        'tgl_mulai_kredit',
        'tgl_selesai_kredit',
        'total_kredit',
        'sisa_kredit',
        'status_kredit',
        'keterangan_status_kredit',
    ];

    protected function casts(): array
    {
        return [
            'tgl_mulai_kredit' => 'date',
            'tgl_selesai_kredit' => 'date',
            'total_kredit' => 'float',
            'sisa_kredit' => 'float',
        ];
    }

    public function pengajuanKredit(): BelongsTo
    {
        return $this->belongsTo(PengajuanKredit::class);
    }

    public function metodeBayar(): BelongsTo
    {
        return $this->belongsTo(MetodeBayar::class);
    }

    public function angsuran(): HasMany
    {
        return $this->hasMany(Angsuran::class);
    }

    public function pengiriman(): HasOne
    {
        return $this->hasOne(Pengiriman::class);
    }
}
