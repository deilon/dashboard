<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subscription_arrangement',
        'tier_name',
        'date',
        'payment_method',
        'customer_name',
        'amount',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
