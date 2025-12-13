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
        Schema::create('app_support_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id')->index();
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->string('file')->nullable();
            $table->tinyInteger('status')->default(0)
                        ->comment('0 = open, 1 = replied, 2 = closed');
            $table->text('reply')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_support_tickets');
    }
};
