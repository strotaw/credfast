<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin CredFast',
                'email' => 'admin@gmail.com',
                'password' => 'password',
                'role' => User::ROLE_ADMIN,
                'no_hp' => '081234567890',
                'alamat' => 'Kantor Pusat CredFast',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '10110',
            ],
            [
                'name' => 'Marketing CredFast',
                'email' => 'marketing@gmail.com',
                'password' => 'password',
                'role' => User::ROLE_MARKETING,
                'no_hp' => '081234567891',
                'alamat' => 'Area Follow Up',
                'kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '40111',
            ],
            [
                'name' => 'CEO CredFast',
                'email' => 'ceo@gmail.com',
                'password' => 'password',
                'role' => User::ROLE_CEO,
                'no_hp' => '081234567892',
                'alamat' => 'Executive Office',
                'kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'kode_pos' => '60222',
            ],
            [
                'name' => 'User CredFast',
                'email' => 'user@gmail.com',
                'password' => 'password',
                'role' => User::ROLE_USER,
                'no_hp' => '081234567893',
                'alamat' => 'Jl. Melati No. 10',
                'kota' => 'Semarang',
                'provinsi' => 'Jawa Tengah',
                'kode_pos' => '50123',
            ],
            [
                'name' => 'Nina Pelanggan',
                'email' => 'nina@gmail.com',
                'password' => 'password',
                'role' => User::ROLE_USER,
                'no_hp' => '081234567894',
                'alamat' => 'Jl. Anggrek No. 18',
                'kota' => 'Yogyakarta',
                'provinsi' => 'DI Yogyakarta',
                'kode_pos' => '55161',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user,
            );
        }
    }
}
