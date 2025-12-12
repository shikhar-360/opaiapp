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
        Schema::create('app_level_packages', function (Blueprint $table) {

            $table->id();

            // Foreign key to apps table
            $table->unsignedBigInteger('app_id');
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');

            $table->unsignedInteger('level');
            $table->unsignedInteger('directs')->default(0);
            $table->decimal('reward', 10, 2)->default(0);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_level_packages');
    }
};
