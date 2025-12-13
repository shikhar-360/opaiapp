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
        Schema::create('leadership_champions_income', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id');
            $table->string('rank', 50);
            $table->unsignedInteger('directs')->default(0);
            $table->decimal('team_volume', 18, 6)->default(0);
            $table->decimal('points', 18, 6)->default(0);
            $table->timestamps();

            $table->foreign('app_id')
                ->references('id')
                ->on('apps')
                ->onDelete('cascade');

            $table->index('rank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leadership_champions_income');
    }
};
