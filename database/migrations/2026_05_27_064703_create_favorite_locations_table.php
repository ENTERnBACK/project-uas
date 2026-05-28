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
        Schema::create('favorite_locations', function (Blueprint $table) {
            $table->id(); // Primary Key otomatis
            
            // Tambahkan kolom-kolom untuk lokasi favorit di bawah ini:
            $table->integer('user_id'); // Mencatat ID pelanggan pemilik alamat ini
            $table->string('label');    // Menyimpan nama tempat (contoh: Rumah, Kosan, Kantor)
            $table->text('alamat');     // Menyimpan teks alamat lengkap tempat tersebut
            
            $table->timestamps(); // membuat kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_locations');
    }
};