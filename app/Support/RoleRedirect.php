<?php

namespace App\Support;

use App\Models\User;

class RoleRedirect
{
    public static function dashboard(string $role): string
    {
        return match ($role) {
            User::ROLE_MARKETING => route('marketing.dashboard'),
            User::ROLE_ADMIN => route('admin.dashboard'),
            User::ROLE_CEO => route('ceo.laporan.penjualan'),
            default => route('user.dashboard'),
        };
    }
}
