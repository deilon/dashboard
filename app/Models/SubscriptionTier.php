<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionTier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tier_name',
        'price',
        'status',
    ];

    public function subscriptionArrangement()
    {
        return $this->belongsTo(SubscriptionArrangement::class);
    }

    public function subscriptions(): HasMany 
    {
        return $this->hasMany(Subscription::class);
    }
}
