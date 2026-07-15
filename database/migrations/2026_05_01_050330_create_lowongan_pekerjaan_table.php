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
        Schema::create('lowongan_pekerjaan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('perusahaan_id')
                ->constrained('perusahaan')
                ->onDelete('cascade');

            $table->string('judul_lowongan');
            $table->string('lokasi');
            $table->string('kategori_label')->nullable();
            $table->text('deskripsi_pekerjaan');
            $table->date('deadline');
            $table->string('status_lowongan');
            $table->integer('jumlah_lowongan_dibuka');
            $table->integer('total_pendaftar');
            $table->integer('total_interview');
            $table->string('tanggal_deadline_label');
            $table->string('gambar_banner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_pekerjaan');
    }
};