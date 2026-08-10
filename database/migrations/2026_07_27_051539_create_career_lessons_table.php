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
        Schema::create('career_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('career_classes')->onDelete('cascade');
            $table->string('judul');
            $table->string('tipe_konten'); // video, artikel, dokumen, quiz
            $table->text('konten')->nullable(); // url video / isi artikel / path file
            $table->integer('urutan'); // penentu urutan buka-kunci lesson
            $table->integer('durasi_menit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_lessons');
    }
};