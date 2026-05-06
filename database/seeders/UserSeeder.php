<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = '12345678';

        $users = [
            [
                'name' => 'Admin CredFast',
                'email' => 'admin@gmail.com',
                'password' => $password,
                'role' => User::ROLE_ADMIN,
                'no_hp' => '081234567890',
                'alamat' => 'Kantor Pusat CredFast',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '10110',
                'foto' => 'seed/profile/admin.png',
            ],
            [
                'name' => 'Marketing CredFast',
                'email' => 'marketing@gmail.com',
                'password' => $password,
                'role' => User::ROLE_MARKETING,
                'no_hp' => '081234567891',
                'alamat' => 'Area Follow Up',
                'kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '40111',
                'foto' => 'seed/profile/marketing.png',
            ],
            [
                'name' => 'Marketing Surabaya',
                'email' => 'marketing.surabaya@gmail.com',
                'password' => $password,
                'role' => User::ROLE_MARKETING,
                'no_hp' => '081234567895',
                'alamat' => 'Jl. Panglima Sudirman No. 21',
                'kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'kode_pos' => '60271',
                'foto' => 'seed/profile/marketing.png',
            ],
            [
                'name' => 'CEO CredFast',
                'email' => 'ceo@gmail.com',
                'password' => $password,
                'role' => User::ROLE_CEO,
                'no_hp' => '081234567892',
                'alamat' => 'Executive Office',
                'kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'kode_pos' => '60222',
                'foto' => 'seed/profile/ceo.png',
            ],
            [
                'name' => 'User CredFast',
                'email' => 'user@gmail.com',
                'password' => $password,
                'role' => User::ROLE_USER,
                'no_hp' => '081234567893',
                'alamat' => 'Jl. Melati No. 10',
                'kota' => 'Semarang',
                'provinsi' => 'Jawa Tengah',
                'kode_pos' => '50123',
                'foto' => 'seed/profile/user.png',
            ],
            [
                'name' => 'Nina Pelanggan',
                'email' => 'nina@gmail.com',
                'password' => $password,
                'role' => User::ROLE_USER,
                'no_hp' => '081234567894',
                'alamat' => 'Jl. Anggrek No. 18',
                'kota' => 'Yogyakarta',
                'provinsi' => 'DI Yogyakarta',
                'kode_pos' => '55161',
                'foto' => 'seed/profile/nina.png',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'password' => $password,
                'role' => User::ROLE_USER,
                'no_hp' => '081222333444',
                'alamat' => 'Jl. Ahmad Yani No. 45',
                'kota' => 'Bekasi',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '17141',
                'foto' => 'seed/profile/budi.png',
            ],
            [
                'name' => 'Sari Lestari',
                'email' => 'sari@gmail.com',
                'password' => $password,
                'role' => User::ROLE_USER,
                'no_hp' => '081333444555',
                'alamat' => 'Jl. Gajah Mada No. 8',
                'kota' => 'Denpasar',
                'provinsi' => 'Bali',
                'kode_pos' => '80111',
                'foto' => 'seed/profile/sari.png',
            ],
            [
                'name' => 'Dimas Pratama',
                'email' => 'dimas@gmail.com',
                'password' => $password,
                'role' => User::ROLE_USER,
                'no_hp' => '081444555666',
                'alamat' => 'Jl. Pahlawan No. 17',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'kode_pos' => '65111',
                'foto' => 'seed/profile/dimas.png',
            ],
        ];

        foreach ($users as $user) {
            $createdUser = User::updateOrCreate(
                ['email' => $user['email']],
                $user,
            );

            $createdUser->syncPelangganProfile();
        }
    }
}
