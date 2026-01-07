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
        Schema::create('customer_settings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('customer_id');

            $table->boolean('isP2P')->default(false);
            $table->boolean('isSelfTransfer')->default(false);
            $table->boolean('isFreePackage')->default(false);
            $table->boolean('isWithdraw')->default(false);

            $table->timestamps();

            // Optional but recommended
            $table->unique(['app_id', 'customer_id']);

            // Foreign keys (if you want strict integrity)
            $table->foreign('app_id')->references('id')->on('apps')->cascadeOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_settings');
    }
};
