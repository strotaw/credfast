<?php

namespace App\Models;

use App\Models\Concerns\HasPublicImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisMotor extends Model
{
    use HasFactory, HasPublicImages;

    protected $table = 'jenis_motor';

    protected $fillable = [
        'merk',
        'tipe',
        'deskripsi_jenis',
        'image_url',
    ];

    public function motor(): HasMany
    {
        return $this->hasMany(Motor::class);
    }

    public function imageUrl(): ?string
    {
        return $this->publicImageUrl($this->image_url);
    }
}
