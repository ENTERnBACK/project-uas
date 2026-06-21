<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
     protected $table = 'payment_methods';
    

    public $incrementing = false; 
    protected $primaryKey = null; 
    
    protected $fillable = ['method', 'trip_id', 'status'];
}
