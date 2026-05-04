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
        Schema::create('motor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_motor_id')->constrained('jenis_motor')->cascadeOnDelete();
            $table->string('nama_motor');
            $table->unsignedBigInteger('harga_jual');
            $table->text('deskripsi_motor');
            $table->string('warna')->nullable();
            $table->string('kapasitas_mesin')->nullable();
            $table->year('tahun')->nullable();
            $table->string('foto1')->nullable();
            $table->string('foto2')->nullable();
            $table->string('foto3')->nullable();
            $table->integer('stok')->default(0);
            $table->enum('status', ['tersedia', 'habis', 'nonaktif'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motor');
    }
};
