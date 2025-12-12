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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('app_id')->constrained('apps')->onDelete('cascade');

            // Payer (Sender)
            $table->foreignId('payer_id')->constrained('customers')->onDelete('cascade');
            
            // Receiver
            $table->foreignId('receiver_id')->constrained('customers')->onDelete('cascade');
            
            $table->decimal('amount', 10, 4); // Use appropriate precision/scale
            $table->string('transaction_id'); 
            $table->string('transaction_type'); // e.g., 'P2P_TRANSFER', 'DEPOSIT', 'WITHDRAWAL', 'ROI-ON-ROI'
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
