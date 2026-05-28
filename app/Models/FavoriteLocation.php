<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteLocation extends Model
{
    // 1. Beritahu Laravel nama tabel yang ada di MySQL kamu
    protected $table = 'favorite_locations';

    // 2. Daftarkan kolom-kolom yang boleh diisi data (Mass Assignment)
    protected $fillable = [
        'user_id', 
        'label', 
        'alamat'
    ];
}