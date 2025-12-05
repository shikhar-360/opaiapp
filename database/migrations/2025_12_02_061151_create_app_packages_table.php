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
        Schema::create('app_packages', function (Blueprint $table) {
            $table->id();
            // Link packages to App (VERY IMPORTANT)
            $table->unsignedBigInteger('app_id')->index();
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
            // Package Info
            $table->string('plan_code')->index(); // Example: P1, P2, P3, P4
            $table->decimal('amount', 10, 2);     // 5, 10, 25, 50
            $table->decimal('roi_percent', 5, 2); // 0.5, 1.0, 1.5, 2.0
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
        Schema::dropIfExists('app_packages');
    }
};
