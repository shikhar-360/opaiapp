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
        Schema::create('customer_deposits', function (Blueprint $table) {
            $table->id();

            // Relationship
            $table->unsignedBigInteger('app_id')->index();
            $table->unsignedBigInteger('customer_id')->index();

            // Deposit Info
            $table->unsignedBigInteger('package_id')->index();
            $table->foreign('package_id')->references('id')->on('app_packages')->onDelete('cascade');
            $table->decimal('amount', 10, 2);      // 5, 10, 25, 50 only
            $table->decimal('roi_percent', 5, 2);  // 0.5, 1.0, 1.5, 2.0
            $table->decimal('roi_earned', 12, 4)->default(0.0000); // for compounding

            // Payment Gateway
            $table->string('transaction_id')->unique()->index(); // 9Pay transaction
            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending');

            $table->decimal('coin_price', 10, 4); // Use appropriate precision/scale
            $table->boolean('is_free_deposit')->default(false);
            $table->enum('is_free_deposit', ['pending', 'success', 'failed'])->default('pending');


            $table->timestamps();

            // Foreign Keys
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_deposits');
    }
};
