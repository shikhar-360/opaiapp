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
        Schema::create('ninepay_transactions', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('customer_id');

            $table->decimal('amount', 16, 6)->default(0);
            $table->decimal('fees_amount', 16, 6)->default(0);
            $table->decimal('received_amount', 16, 6)->default(0);

            // Amounts are stored as VARCHAR(255) as per your SQL
            $table->string('chain', 255);
            $table->string('currency', 225);

            // status is an INT NOT NULL
            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending');
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
        Schema::dropIfExists('ninepay_transactions');
    }
};
