<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subscription_name',
        'status',
        'start_date',
        'end_date',
    ];

    public function subscriptionTiers(): HasMany
    {
        return $this->hasMany(SubscriptionTier::class, 'subscription_plan_id');
    }
}
