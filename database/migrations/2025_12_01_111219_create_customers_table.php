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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            // Foreign Key → apps.id
            $table->unsignedBigInteger('app_id')->index();
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('wallet_address')->nullable()->index();
            // Referral System
            $table->string('referral_code')->nullable()->unique()->index(); // Example: CUSTX82KF
            $table->unsignedBigInteger('sponsor_id')->nullable()->index(); // customer_id of sponsor
            $table->longText('direct_ids')->nullable(); // “3/7/9/...”
            $table->boolean('status')->default(true);
            $table->string('remember_token')->nullable();
            $table->string('role')->default('customer');
            $table->unsignedBigInteger('level_id')->nullable()->index();
            $table->string('nonce')->nullable();
            $table->foreign('level_id')->references('id')->on('app_level_packages')->onDelete('cascade');
            $table->timestamps();

            // team_business DECIMAL(18,6) DEFAULT 0,
            // direct_team_count INT DEFAULT 0,
            // total_team_count INT DEFAULT 0,
            // active_direct_team INT DEFAULT 0,
            // daily_team_business DECIMAL(18,6) DEFAULT 0,
            // weekly_team_business DECIMAL(18,6) DEFAULT 0, 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
