<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('favorite_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->index();
            $table->string('label')->index(); 
            $table->text('alamat');
            $table->boolean('is_default')->default(false); 
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('favorite_locations');
    }
};