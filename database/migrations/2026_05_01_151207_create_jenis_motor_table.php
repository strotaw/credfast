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
        Schema::create('jenis_motor', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->enum('tipe', [
                'bebek',
                'skuter',
                'dual_sport',
                'naked_sport',
                'sport_bike',
                'retro',
                'cruiser',
                'sport_touring',
                'dirt_bike',
                'motocross',
                'scrambler',
                'atv',
                'motor_adventure',
                'lainnya',
            ]);
            $table->text('deskripsi_jenis')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_motor');
    }
};
