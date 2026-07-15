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
        Schema::create('syarat_khusus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lowongan_id')->constrained('lowongan_pekerjaan')->onDelete('cascade');
            $table->string('syarat_khusus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_khusus');
    }
};
