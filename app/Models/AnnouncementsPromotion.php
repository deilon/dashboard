<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementsPromotion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ap_title',
        'ap_description',
        'ap_tag',
        'ap_photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
