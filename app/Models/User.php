<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function subscriptions(): HasMany 
    {
        return $this->hasMany(Subscription::class);
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

    public function announcementPromotions(): HasMany 
    {
        return $this->hasMany(AnnouncementPromotions::class);
    }

    public function progressWeek(): HasMany 
    {
        return $this->hasMany(ProgressWeek::class);
    }

    /**
     * Interact with the user's role name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value,
        );
    }
}
