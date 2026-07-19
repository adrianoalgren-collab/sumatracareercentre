<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lamaran', function (Blueprint $table) {
            $table->dateTime('jadwal_interview')->nullable()->after('status');
            $table->string('lokasi_interview')->nullable()->after('jadwal_interview');
            $table->text('catatan_interview')->nullable()->after('lokasi_interview');
        });
    }

    public function down(): void
    {
        Schema::table('lamaran', function (Blueprint $table) {
            $table->dropColumn(['jadwal_interview', 'lokasi_interview', 'catatan_interview']);
        });
    }
};