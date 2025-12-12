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
        Schema::create('free_deposit_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id')->index();
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
            // Package Info
            $table->unsignedBigInteger('package_id')->index();
            $table->foreign('package_id')->references('id')->on('app_packages')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id')->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            // For future flexibility
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_deposit_packages');
    }
};
