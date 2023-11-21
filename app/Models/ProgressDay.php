<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgressDay extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'day_title',
        'day_number',
        'status'
    ];

    public function progressWeek()
    {
        return $this->belongsTo(ProgressWeek::class);
    }    
    
    public function progressDayTask(): HasMany 
    {
        return $this->hasMany(ProgressDayTask::class);
    }
}
