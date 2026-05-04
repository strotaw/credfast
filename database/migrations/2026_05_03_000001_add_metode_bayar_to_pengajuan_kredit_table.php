<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengajuan_kredit', function (Blueprint $table) {
            $table->foreignId('metode_bayar_id')->nullable()->constrained('metode_bayar')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_kredit', function (Blueprint $table) {
            $table->dropConstrainedForeignId('metode_bayar_id');
        });
    }
};
