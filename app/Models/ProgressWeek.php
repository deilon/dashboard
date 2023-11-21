<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgressWeek extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'week_number',
        'week_title',
        'status',
        'start_date',
        'end_date',
        'author',
    ];

    public function progressDay(): HasMany 
    {
        return $this->hasMany(ProgressDay::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
}
