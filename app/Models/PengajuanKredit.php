<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PengajuanKredit extends Model
{
    use HasFactory;

    public const STATUS_MENUNGGU_KONFIRMASI = 'menunggu_konfirmasi';

    public const STATUS_DIPROSES = 'diproses';

    public const STATUS_DIBATALKAN_PEMBELI = 'dibatalkan_pembeli';

    public const STATUS_DIBATALKAN_PENJUAL = 'dibatalkan_penjual';

    public const STATUS_BERMASALAH = 'bermasalah';

    public const STATUS_DITERIMA = 'diterima';

    public const STATUS_OPTIONS = [
        self::STATUS_MENUNGGU_KONFIRMASI,
        self::STATUS_DIPROSES,
        self::STATUS_DIBATALKAN_PEMBELI,
        self::STATUS_DIBATALKAN_PENJUAL,
        self::STATUS_BERMASALAH,
        self::STATUS_DITERIMA,
    ];

    protected $table = 'pengajuan_kredit';

    protected $fillable = [
        'pelanggan_id',
        'motor_id',
        'jenis_cicilan_id',
        'asuransi_id',
        'metode_bayar_id',
        'tgl_pengajuan_kredit',
        'harga_cash',
        'dp',
        'harga_kredit',
        'biaya_asuransi_perbulan',
        'cicilan_perbulan',
        'url_kk',
        'url_ktp',
        'url_npwp',
        'url_slip_gaji',
        'url_foto',
        'status_pengajuan',
        'catatan_marketing',
        'marketing_id',
        'admin_id',
        'keterangan_status_pengajuan',
    ];

    protected function casts(): array
    {
        return [
            'tgl_pengajuan_kredit' => 'date',
            'harga_cash' => 'integer',
            'dp' => 'integer',
            'harga_kredit' => 'float',
            'biaya_asuransi_perbulan' => 'float',
            'cicilan_perbulan' => 'float',
        ];
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function getUserAttribute(): ?User
    {
        return $this->pelanggan?->user;
    }

    public function motor(): BelongsTo
    {
        return $this->belongsTo(Motor::class);
    }

    public function jenisCicilan(): BelongsTo
    {
        return $this->belongsTo(JenisCicilan::class);
    }

    public function asuransi(): BelongsTo
    {
        return $this->belongsTo(Asuransi::class);
    }

    public function metodeBayar(): BelongsTo
    {
        return $this->belongsTo(MetodeBayar::class);
    }

    public function marketing(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marketing_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function kredit(): HasOne
    {
        return $this->hasOne(Kredit::class);
    }
}
