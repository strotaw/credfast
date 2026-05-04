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
        Schema::create('kredit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_kredit_id')->unique();
            $table->unsignedBigInteger('metode_bayar_id')->nullable();
            $table->string('no_kontrak')->unique();
            $table->date('tgl_mulai_kredit');
            $table->date('tgl_selesai_kredit');
            $table->double('total_kredit');
            $table->double('sisa_kredit');
            $table->enum('status_kredit', ['aktif', 'macet', 'lunas', 'dibatalkan'])->default('aktif');
            $table->text('keterangan_status_kredit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kredit');
    }
};
