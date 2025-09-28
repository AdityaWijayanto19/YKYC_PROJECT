<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Ini adalah daftar kolom yang boleh diisi melalui Order::create().
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'worker_id',
        'service_id',
        'delivery_method',
        'location_id',
        'customer_address',
        'service_price',
        'delivery_fee',
        'total_price',
        'status',
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
}