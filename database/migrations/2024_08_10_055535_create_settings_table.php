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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->char('telegram_id', 10)->nullable();
            $table->char('telegram_token', 10)->nullable();
            $table->integer('wallets')->nullable();
            $table->string('header', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('site_title', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
