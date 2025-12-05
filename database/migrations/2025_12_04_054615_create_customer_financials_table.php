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
        Schema::create('customer_financials', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('customer_id');

            $table->decimal('total_deposit', 16, 6)->default(0);
            $table->decimal('total_roi', 16, 6)->default(0);
            $table->decimal('total_withdraws', 16, 6)->default(0);

            $table->decimal('capping_limit', 16, 6)->default(0);

            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->unique(['app_id', 'customer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_financials');
    }
};
