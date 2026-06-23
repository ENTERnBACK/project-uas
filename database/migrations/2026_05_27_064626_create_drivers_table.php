<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            
            $table->string('nama');            
            $table->string('email')->unique(); 
            $table->string('no_telepon');      
            $table->text('alamat');            
            $table->string('jenis_kendaraan'); 
            $table->string('status')->default('nonaktif'); 
            $table->string('plate_nomor');    
            $table->string('foto_profil')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};