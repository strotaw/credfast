<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Angsuran extends Model
{
    use HasFactory;

    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_DIBAYAR = 'dibayar';
    public const STATUS_VALID = 'valid';
    public const STATUS_DITOLAK = 'ditolak';
    public const STATUS_TELAT = 'telat';

    public const STATUS_OPTIONS = [
        self::STATUS_MENUNGGU,
        self::STATUS_DIBAYAR,
        self::STATUS_VALID,
        self::STATUS_DITOLAK,
        self::STATUS_TELAT,
    ];

    protected $table = 'angsuran';

    protected $fillable = [
        'kredit_id',
        'angsuran_ke',
        'tanggal_jatuh_tempo',
        'tanggal_bayar',
        'nominal',
        'denda',
        'total_bayar',
        'bukti_bayar',
        'status',
        'verified_by',
        'verified_at',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_jatuh_tempo' => 'date',
            'tanggal_bayar' => 'date',
            'verified_at' => 'datetime',
            'nominal' => 'float',
            'denda' => 'float',
            'total_bayar' => 'float',
        ];
    }

    public function kredit(): BelongsTo
    {
        return $this->belongsTo(Kredit::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
