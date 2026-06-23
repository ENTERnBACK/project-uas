<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'passenger_name',
        'passenger_id',
        'total_amount',
        'tip_amount',
        'status',
        'payment_time'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'tip_amount' => 'decimal:2',
        'payment_time' => 'datetime',
    ];


    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function getFinalAmountAttribute()
    {
        return $this->total_amount;
    }

    public function isPaid()
    {
        return $this->status === 'paid';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }


    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeByTrip($query, $tripId)
    {
        return $query->where('trip_id', $tripId);
    }
}