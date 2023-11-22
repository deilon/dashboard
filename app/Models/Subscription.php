<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;
    protected $dates = ['start_date', 'end_date'];
    public $timestamps = true;


    public static function boot()
    {
        parent::boot();

        static::saving(function ($subscription) {
            // Check if the end_date has passed
            if ($subscription->end_date < now()) {
                $subscription->status = 'expired';
            }
        });
    }

    public function subscriptionArrangement()
    {
        return $this->belongsTo(SubscriptionArrangement::class);
    }

    public function subscriptionTier()
    {
        return $this->belongsTo(SubscriptionTier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creditCard(): HasMany 
    {
        return $this->hasMany(CreditCard::class);
    }

    public function gcash(): HasMany 
    {
        return $this->hasMany(Gcash::class);
    }

    public function manualPayment(): HasMany 
    {
        return $this->hasMany(ManualPayment::class);
    }

    public function sale(): HasMany 
    {
        return $this->hasMany(Sale::class);
    }
}
