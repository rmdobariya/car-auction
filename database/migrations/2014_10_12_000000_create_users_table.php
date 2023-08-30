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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('user_type', ['user', 'admin'])->default('user');
            $table->enum('status', ['active', 'inActive'])->default('active');
            $table->enum('locale', ['en', 'ar'])->default('en');
            $table->string('image',255)->nullable();
            $table->tinyInteger('panel_mode')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',191);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
