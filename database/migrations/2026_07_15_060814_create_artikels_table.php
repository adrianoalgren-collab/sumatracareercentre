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
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori')->nullable();
            $table->text('ringkasan')->nullable();
            $table->longText('konten');
            $table->string('gambar_utama')->nullable();
            $table->unsignedInteger('waktu_baca_menit')->default(5);
            $table->string('tags')->nullable();

            $table->string('penulis_nama')->nullable();
            $table->string('penulis_jabatan')->nullable();
            $table->string('penulis_foto')->nullable();
            $table->text('penulis_bio')->nullable();

            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};