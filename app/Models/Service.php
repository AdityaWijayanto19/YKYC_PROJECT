<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    /**
     * Mendefinisikan relasi: Satu Service bisa dimiliki oleh banyak Order.
     */
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}