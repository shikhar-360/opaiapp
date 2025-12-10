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
            $table->string('transaction_id', 255)->nullable();	
            $table->text('eth_9pay_json');
            $table->text('tron_9pay_json');
            $table->string('payment_address'); 
            
            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('customer_id');

            $table->decimal('amount', 16, 6)->default(0);
            $table->decimal('fees_amount', 16, 6)->default(0);
            $table->decimal('received_amount', 16, 6)->default(0);

            // Amounts are stored as VARCHAR(255) as per your SQL
            $table->string('chain', 255);
            $table->string('currency', 225);

            $table->string('transaction_hash', 255)->nullable(); 
            // status is an INT NOT NULL
            $table->enum('payment_status', ['pending', 'success', 'failed', 'underpaid'])->default('pending');
            $table->timestamps(); 

            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unique(
                ['app_id', 'transaction_id', 'payment_address', 'customer_id', 'transaction_hash'], 
                'unique_ninepay_payment'
            );
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
