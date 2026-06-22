<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteLocation extends Model
{

    protected $table = 'favorite_locations';

   
    protected $fillable = [
        'user_id', 
        'label', 
        'alamat'
    ];
}