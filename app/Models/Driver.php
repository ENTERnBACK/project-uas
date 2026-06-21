<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    // Mengizinkan kolom-kolom ini diisi data
    protected $fillable = [
        'nama',
        'email',
        'no_telepon', 
        'alamat',
        'jenis_kendaraan',
        'status',
        'plate_nomor', // Tambahan agar sesuai dengan migrasi dan form create
    ];
}
