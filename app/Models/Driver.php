<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini

class Driver extends Model
{
    use HasFactory; // Tambahkan ini

    protected $fillable = [
        'nama',
        'email',
        'no_telepon', 
        'alamat',
        'jenis_kendaraan',
        'status',
        'plate_nomor', 
    ];
}