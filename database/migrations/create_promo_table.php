<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();

            $table->enum('discount_type', ['percentage', 'fixed']);
            
            $table->decimal('discount_value', 10, 2);
            
            $table->decimal('max_discount', 10, 2)->nullable();
            
            $table->decimal('min_transaction', 10, 2)->default(0);
            
            $table->integer('usage_limit')->nullable();
            $table->integer('usage_count')->default(0);
  
            $table->enum('status', ['active', 'expired', 'disabled'])->default('active');

            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_until')->nullable();
            
            $table->timestamps();

            $table->index('code');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};