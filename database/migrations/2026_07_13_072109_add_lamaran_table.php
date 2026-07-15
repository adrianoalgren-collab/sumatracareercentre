<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // FIX: tabel aslinya "lowongan_pekerjaan", bukan "lowongans"
            $table->foreignId('lowongan_id')
                ->constrained('lowongan_pekerjaan')
                ->cascadeOnDelete();

            // CV yang dipakai untuk lamaran ini (boleh salah satu dokumen
            // yang sudah ada di profil user, atau dokumen baru yang di-upload
            // khusus saat melamar).
            $table->foreignId('document_id')
                ->nullable()
                ->constrained('documents')
                ->nullOnDelete();

            $table->text('surat_lamaran');

            // snapshot data diri saat melamar (jaga-jaga kalau profil user
            // berubah setelah melamar)
            $table->string('nama');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            $table->enum('status', ['pending', 'diterima', 'ditolak', 'interview'])
                ->default('pending');

            $table->timestamps();

            // satu user hanya bisa melamar sekali per lowongan
            $table->unique(['user_id', 'lowongan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lamaran');
    }
};