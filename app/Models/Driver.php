<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Driver extends Model
{
    use HasFactory; 

    protected $fillable = [
        'nama',
        'email',
        'no_telepon', 
        'alamat',
        'jenis_kendaraan',
        'plate_nomor',
        'foto_profil', 
    ];
}