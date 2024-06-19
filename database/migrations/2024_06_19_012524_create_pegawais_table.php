<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\text;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('nohp')->unique();
            $table->string('foto_pegawai');
            $table->enum('agama', ['Islam', 'Kristen', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('pendidikan', ['SMA/SMK/Sederajat', 'S1', 'S2', 'S3', 'D1', 'D2', 'D3', 'D4']);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
