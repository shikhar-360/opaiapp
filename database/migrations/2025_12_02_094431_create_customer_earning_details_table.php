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
        Schema::create('customer_earning_details', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('app_id')->index();
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');      
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('reference_id')->constrained('customer_deposits')->onDelete('cascade');
            $table->decimal('amount_earned', 12, 4);
            $table->enum('earning_type', ['ROI', 'LEVEL-INCOME', 'BONUS'])->index();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_earning_details');
    }
};
