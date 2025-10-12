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
        // Dapatkan ID dari status 'completed'
        $completedStatusId = Status::where('name', 'completed')->value('id');

        // Hitung jumlah order yang sudah selesai milik worker ini
        return $this->orders()
            ->where('status_id', $completedStatusId)
            ->count();
    }

    public function getAverageRatingAttribute()
    {
        // Ambil rata-rata rating dari feedback berdasarkan worker_id
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
