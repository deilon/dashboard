<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionArrangement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'arrangement_name',
        'status',
        'start_date',
        'end_date',
    ];

    public function subscriptionTiers(): HasMany
    {
        return $this->hasMany(SubscriptionTier::class);
    }
}
