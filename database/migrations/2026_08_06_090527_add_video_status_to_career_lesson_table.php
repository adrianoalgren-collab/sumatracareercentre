<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('career_lessons', function (Blueprint $table) {
            // ready       -> tidak butuh transcode / sudah selesai diproses & siap ditonton
            // processing  -> video baru diupload, job transcode sedang berjalan
            // failed      -> job transcode gagal, perlu re-upload
            $table->string('video_status')->default('ready')->after('file_path');
        });
    }

    public function down(): void
    {
        Schema::table('career_lessons', function (Blueprint $table) {
            $table->dropColumn('video_status');
        });
    }
};