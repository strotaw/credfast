<?php

namespace App\Models;

use App\Models\Concerns\HasPublicImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Motor extends Model
{
    use HasFactory, HasPublicImages;

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

    public function primaryFotoUrl(): ?string
    {
        foreach (['foto1', 'foto2', 'foto3'] as $field) {
            $url = $this->publicImageUrl($this->{$field});

            if ($url) {
                return $url;
            }
        }

        return null;
    }

    public function fotoUrl(string $field): ?string
    {
        if (! in_array($field, ['foto1', 'foto2', 'foto3'], true)) {
            return null;
        }

        return $this->publicImageUrl($this->{$field});
    }

    public function fotoUrls(): array
    {
        return collect([$this->foto1, $this->foto2, $this->foto3])
            ->map(fn (?string $path) => $this->publicImageUrl($path))
            ->filter()
            ->values()
            ->all();
    }

    public function pengajuanKredit(): HasMany
    {
        return $this->hasMany(PengajuanKredit::class);
    }
}
