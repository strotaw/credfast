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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->unique()->constrained('users')->cascadeOnDelete();
            $table->string('nama_pelanggan');
            $table->string('email')->unique();
            $table->string('katakunci')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('alamat1')->nullable();
            $table->string('kota1')->nullable();
            $table->string('propinsi1')->nullable();
            $table->string('kodepos1')->nullable();
            $table->string('alamat2')->nullable();
            $table->string('kota2')->nullable();
            $table->string('propinsi2')->nullable();
            $table->string('kodepos2')->nullable();
            $table->string('alamat3')->nullable();
            $table->string('kota3')->nullable();
            $table->string('propinsi3')->nullable();
            $table->string('kodepos3')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        DB::table('users')
            ->where('role', 'user')
            ->orderBy('id')
            ->get()
            ->each(function (object $user): void {
                DB::table('pelanggan')->insert([
                    'user_id' => $user->id,
                    'nama_pelanggan' => $user->name,
                    'email' => $user->email,
                    'katakunci' => $user->password,
                    'no_telp' => $user->no_hp,
                    'alamat1' => $user->alamat,
                    'kota1' => $user->kota,
                    'propinsi1' => $user->provinsi,
                    'kodepos1' => $user->kode_pos,
                    'foto' => $user->foto,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
