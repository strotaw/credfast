<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PengajuanKredit extends Model
{
    use HasFactory;

    public const STATUS_MENUNGGU = 'menunggu';

    public const STATUS_DIPROSES = 'diproses';

    public const STATUS_DATA_KURANG = 'data_kurang';

    public const STATUS_SURVEY = 'survey';

    public const STATUS_DIREKOMENDASIKAN = 'direkomendasikan';

    public const STATUS_TIDAK_DIREKOMENDASIKAN = 'tidak_direkomendasikan';

    public const STATUS_DITERIMA = 'diterima';

    public const STATUS_DITOLAK = 'ditolak';

    public const STATUS_DIBATALKAN_USER = 'dibatalkan_user';

    public const STATUS_OPTIONS = [
        self::STATUS_MENUNGGU,
        self::STATUS_DIPROSES,
        self::STATUS_DATA_KURANG,
        self::STATUS_SURVEY,
        self::STATUS_DIREKOMENDASIKAN,
        self::STATUS_TIDAK_DIREKOMENDASIKAN,
        self::STATUS_DITERIMA,
        self::STATUS_DITOLAK,
        self::STATUS_DIBATALKAN_USER,
    ];

    protected $table = 'pengajuan_kredit';

    protected $fillable = [
        'user_id',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
