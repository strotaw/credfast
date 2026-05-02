<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengiriman extends Model
{
    use HasFactory;

    public const STATUS_DIPROSES = 'diproses';
    public const STATUS_DIKIRIM = 'dikirim';
    public const STATUS_DITERIMA = 'diterima';

    protected $table = 'pengiriman';

    protected $fillable = [
        'kredit_id',
        'no_invoice',
        'tgl_kirim',
        'tgl_tiba',
        'status_kirim',
        'nama_kurir',
        'telpon_kurir',
        'bukti_foto',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tgl_kirim' => 'datetime',
            'tgl_tiba' => 'datetime',
        ];
    }

    public function kredit(): BelongsTo
    {
        return $this->belongsTo(Kredit::class);
    }
}
