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
        Schema::create('pengajuan_kredit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->cascadeOnDelete();
            $table->foreignId('motor_id')->constrained('motor')->cascadeOnDelete();
            $table->foreignId('jenis_cicilan_id')->constrained('jenis_cicilan')->cascadeOnDelete();
            $table->foreignId('asuransi_id')->nullable()->constrained('asuransi')->nullOnDelete();
            $table->date('tgl_pengajuan_kredit');
            $table->unsignedBigInteger('harga_cash');
            $table->unsignedBigInteger('dp');
            $table->double('harga_kredit');
            $table->double('biaya_asuransi_perbulan')->default(0);
            $table->double('cicilan_perbulan');
            $table->string('url_kk')->nullable();
            $table->string('url_ktp')->nullable();
            $table->string('url_npwp')->nullable();
            $table->string('url_slip_gaji')->nullable();
            $table->string('url_foto')->nullable();
            $table->enum('status_pengajuan', [
                'menunggu_konfirmasi',
                'diproses',
                'dibatalkan_pembeli',
                'dibatalkan_penjual',
                'bermasalah',
                'diterima',
            ])->default('menunggu_konfirmasi');
            $table->text('catatan_marketing')->nullable();
            $table->foreignId('marketing_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('keterangan_status_pengajuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kredit');
    }
};
