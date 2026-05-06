<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('pengajuan_kredit', 'pelanggan_id')) {
            Schema::table('pengajuan_kredit', function (Blueprint $table) {
                $table->foreignId('pelanggan_id')->nullable()->after('id')->constrained('pelanggan')->cascadeOnDelete();
            });
        }

        if (Schema::hasColumn('pengajuan_kredit', 'user_id')) {
            DB::table('pengajuan_kredit')
                ->join('pelanggan', 'pengajuan_kredit.user_id', '=', 'pelanggan.user_id')
                ->update(['pengajuan_kredit.pelanggan_id' => DB::raw('pelanggan.id')]);

            Schema::table('pengajuan_kredit', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('pengajuan_kredit', 'user_id')) {
            Schema::table('pengajuan_kredit', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->cascadeOnDelete();
            });
        }

        if (Schema::hasColumn('pengajuan_kredit', 'pelanggan_id')) {
            DB::table('pengajuan_kredit')
                ->join('pelanggan', 'pengajuan_kredit.pelanggan_id', '=', 'pelanggan.id')
                ->update(['pengajuan_kredit.user_id' => DB::raw('pelanggan.user_id')]);

            Schema::table('pengajuan_kredit', function (Blueprint $table) {
                $table->dropForeign(['pelanggan_id']);
                $table->dropColumn('pelanggan_id');
            });
        }
    }
};
