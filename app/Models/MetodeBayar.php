<?php

namespace App\Models;

use App\Models\Concerns\HasPublicImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MetodeBayar extends Model
{
    use HasFactory, HasPublicImages;

    public const STATUS_AKTIF = 'aktif';

    public const STATUS_NONAKTIF = 'nonaktif';

    protected $table = 'metode_bayar';

    protected $fillable = [
        'nama_bank',
        'nomor_rekening',
        'atas_nama',
        'url_logo',
        'status',
    ];

    public function kredit(): HasMany
    {
        return $this->hasMany(Kredit::class);
    }

    public function logoUrl(): ?string
    {
        return $this->publicImageUrl($this->url_logo);
    }
}
