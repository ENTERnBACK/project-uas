<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
     protected $table = 'payment_methods';

    // Penting: Beritahu Laravel bahwa trip_id adalah kunci pencarian
    protected $primaryKey = 'trip_id'; 
    public $incrementing = false; 
    
    protected $fillable = ['method', 'trip_id', 'status'];
}
