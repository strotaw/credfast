<?php

namespace App\Support;

use App\Models\LogAktivitas;
use App\Models\User;

class ActivityLogger
{
    public static function log(?User $user, string $aktivitas, string $tabel, ?int $dataId = null, ?string $keterangan = null): void
    {
        LogAktivitas::create([
            'user_id' => $user?->id,
            'role' => $user?->role,
            'aktivitas' => $aktivitas,
            'tabel' => $tabel,
            'data_id' => $dataId,
            'keterangan' => $keterangan,
        ]);
    }
}
