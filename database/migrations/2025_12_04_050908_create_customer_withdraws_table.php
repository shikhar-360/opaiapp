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
        Schema::create('customer_withdraws', function (Blueprint $table) {
            $table->id();

            $table->foreignId('app_id')->constrained('apps')->onDelete('cascade');

            // Payer (Sender)
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            
            $table->decimal('admin_charge', 10, 4); // Use appropriate precision/scale
            $table->decimal('fees', 10, 4); // Use appropriate precision/scale
            $table->decimal('coin_price', 10, 4); // Use appropriate precision/scale
            $table->decimal('amount', 10, 4); // Use appropriate precision/scale
            $table->decimal('admin_charge_amount', 10, 4); // Use appropriate precision/scale
            $table->decimal('fees_amount', 10, 4); // Use appropriate precision/scale
            $table->decimal('net_amount', 10, 4); // Use appropriate precision/scale

            $table->string('transaction_id'); 
            $table->string('transaction_type'); // e.g., 'WITHDRAWAL'
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_withdraws');
    }
};
