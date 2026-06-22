<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    
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
