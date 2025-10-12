<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'worker_id',
        'service_id',
        'delivery_method',
        'location_id',
        'customer_address',
        'customer_lat',
        'customer_lng',
        'service_price',
        'delivery_fee',
        'total_price',
        'status_id',
        'payment_status',
        'snap_token',
    ];

    /**
     * Mendefinisikan relasi: Satu Order dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan relasi: Satu Order dimiliki oleh satu Service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Mendefinisikan relasi: Satu Order dimiliki oleh satu Location (bisa juga tidak).
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Mendefinisikan relasi: Satu Order dikerjakan oleh satu Worker (bisa juga tidak).
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function feedback()
    {
        // Sebuah Order memiliki satu Feedback
        return $this->hasOne(Feedback::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
