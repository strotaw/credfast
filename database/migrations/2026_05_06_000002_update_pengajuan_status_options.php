<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pengajuan_kredit') || ! Schema::hasColumn('pengajuan_kredit', 'status_pengajuan')) {
            return;
        }

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pengajuan_kredit MODIFY status_pengajuan ENUM('menunggu','menunggu_konfirmasi','diproses','data_kurang','survey','direkomendasikan','tidak_direkomendasikan','diterima','ditolak','dibatalkan_user','dibatalkan_pembeli','dibatalkan_penjual','bermasalah') NOT NULL DEFAULT 'menunggu_konfirmasi'");
        }

        DB::table('pengajuan_kredit')->where('status_pengajuan', 'menunggu')->update(['status_pengajuan' => 'menunggu_konfirmasi']);
        DB::table('pengajuan_kredit')->where('status_pengajuan', 'data_kurang')->update(['status_pengajuan' => 'bermasalah']);
        DB::table('pengajuan_kredit')->where('status_pengajuan', 'survey')->update(['status_pengajuan' => 'diproses']);
        DB::table('pengajuan_kredit')->where('status_pengajuan', 'direkomendasikan')->update(['status_pengajuan' => 'diproses']);
        DB::table('pengajuan_kredit')->where('status_pengajuan', 'tidak_direkomendasikan')->update(['status_pengajuan' => 'bermasalah']);
        DB::table('pengajuan_kredit')->where('status_pengajuan', 'ditolak')->update(['status_pengajuan' => 'dibatalkan_penjual']);
        DB::table('pengajuan_kredit')->where('status_pengajuan', 'dibatalkan_user')->update(['status_pengajuan' => 'dibatalkan_pembeli']);

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pengajuan_kredit MODIFY status_pengajuan ENUM('menunggu_konfirmasi','diproses','dibatalkan_pembeli','dibatalkan_penjual','bermasalah','diterima') NOT NULL DEFAULT 'menunggu_konfirmasi'");
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('pengajuan_kredit') || ! Schema::hasColumn('pengajuan_kredit', 'status_pengajuan')) {
            return;
        }

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pengajuan_kredit MODIFY status_pengajuan ENUM('menunggu','menunggu_konfirmasi','diproses','data_kurang','survey','direkomendasikan','tidak_direkomendasikan','diterima','ditolak','dibatalkan_user','dibatalkan_pembeli','dibatalkan_penjual','bermasalah') NOT NULL DEFAULT 'menunggu'");
        }

        DB::table('pengajuan_kredit')->where('status_pengajuan', 'menunggu_konfirmasi')->update(['status_pengajuan' => 'menunggu']);
        DB::table('pengajuan_kredit')->where('status_pengajuan', 'dibatalkan_pembeli')->update(['status_pengajuan' => 'dibatalkan_user']);
        DB::table('pengajuan_kredit')->where('status_pengajuan', 'dibatalkan_penjual')->update(['status_pengajuan' => 'ditolak']);
        DB::table('pengajuan_kredit')->where('status_pengajuan', 'bermasalah')->update(['status_pengajuan' => 'data_kurang']);

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pengajuan_kredit MODIFY status_pengajuan ENUM('menunggu','diproses','data_kurang','survey','direkomendasikan','tidak_direkomendasikan','diterima','ditolak','dibatalkan_user') NOT NULL DEFAULT 'menunggu'");
        }
    }
};
