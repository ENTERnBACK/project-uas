<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    protected $table = 'payment_methods';

    // Pake ID standar Laravel biar aman
    protected $primaryKey = 'id'; 
    public $incrementing = true; 
    
    // Tambahin user_id biar sistem tahu ini punya siapa
    protected $fillable = [
        'user_id', 
        'method', 
        'label', 
        'details', 
        'status'
    ];

    // Biar otomatis bisa baca data JSON di kolom 'details'
    protected $casts = [
        'details' => 'array',
    ];
}
