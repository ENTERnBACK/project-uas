<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id');
            $table->string('passenger_id');
            $table->string('passenger_name');
            
            $table->decimal('total_amount', 10, 2);
            
            $table->decimal('tip_amount', 10, 2)->default(0);
            
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            
            $table->timestamp('payment_time')->nullable();
  
            $table->timestamps();

            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');

            $table->index('passenger_id');
            $table->index('status');
            $table->index('trip_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};