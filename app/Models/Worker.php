<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'worker_type',
        'current_latitude',
        'current_longitude',
        'is_active',
        'location_name',
        'total_orders',
        'average_rating',
    ];


    public function getTotalOrdersAttribute()
    {
        $completedStatusId = Status::where('name', 'completed')->value('id');

        return $this->orders()
            ->where('status_id', $completedStatusId)
            ->count();
    }

    public function getAverageRatingAttribute()
    {
        return round(
            \App\Models\Feedback::where('worker_id', $this->id)->avg('rating'),
            1
        ) ?? 0;
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
