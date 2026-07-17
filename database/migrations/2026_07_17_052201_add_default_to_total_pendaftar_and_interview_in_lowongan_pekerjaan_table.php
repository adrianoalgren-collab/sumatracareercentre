<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('lowongan_pekerjaan', function (Blueprint $table) {
            $table->integer('total_pendaftar')->default(0)->change();
            $table->integer('total_interview')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lowongan_pekerjaan', function (Blueprint $table) {
            //
        });
    }
};
