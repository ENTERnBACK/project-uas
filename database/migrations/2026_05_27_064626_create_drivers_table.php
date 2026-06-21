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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id(); // Primary Key otomatis
            
            // Tambahkan kolom-kolom driver di bawah ini:
            $table->string('nama');            // Menyinpan nama driver
            $table->string('email')->unique(); // Menyimpan email driver (tidak boleh kembar)
            $table->string('no_telepon');      // Menyimpan nomor telepon driver
            $table->text('alamat');            // Menyimpan alamat lengkap driver
            $table->string('jenis_kendaraan'); // Menyimpan jenis kendaraan (GoRide / GoCar)
            $table->string('status')->default('nonaktif'); // Menyimpan status (aktif / nonaktif)
            $table->string('plate_nomor');    // Menyimpan nomor plate kendaraan
            
            $table->timestamps(); // create_at dan updated_at otomatis
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