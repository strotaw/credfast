<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisCicilan extends Model
{
    use HasFactory;

    protected $table = 'jenis_cicilan';

    protected $fillable = [
        'lama_cicilan',
        'margin_kredit',
    ];

    protected function casts(): array
    {
        return [
            'lama_cicilan' => 'integer',
            'margin_kredit' => 'decimal:2',
        ];
    }

    public function pengajuanKredit(): HasMany
    {
        return $this->hasMany(PengajuanKredit::class);
    }
}
