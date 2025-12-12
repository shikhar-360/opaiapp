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
        Schema::create('app_leadership_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id')->index();
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
            $table->string('rank');
            $table->unsignedBigInteger('volume')->nullable()->index();
            $table->unsignedBigInteger('points')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_leadership_packages');
    }
};
