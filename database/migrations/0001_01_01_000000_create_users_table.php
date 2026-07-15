<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Authentication
            |--------------------------------------------------------------------------
            */

            $table->string('password');
            $table->rememberToken();

            /*
            |--------------------------------------------------------------------------
            | Role Management
            |--------------------------------------------------------------------------
            */

            $table->enum('role', [
                'admin',
                'pelamar',
                'perusahaan'
            ])->default('pelamar');

            /*
            |--------------------------------------------------------------------------
            | User Profile
            |--------------------------------------------------------------------------
            */

            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Company Specific
            |--------------------------------------------------------------------------
            */

            $table->string('company_name')->nullable();
            $table->string('company_website')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};