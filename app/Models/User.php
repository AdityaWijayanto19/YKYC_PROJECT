<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class  User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'number_phone',
        'role',
        'google_id',
        'google_token',
        'google_refresh_token',
        'avatar',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getProfileCompletionPercentageAttribute(): int
    {
        $score = 0;
        $totalFields = 5;

        if (!empty($this->name)) {
            $score++;
        }
        if (!empty($this->number_phone)) {
            $score++;
        }
        if ($this->customer) {
            if (!empty($this->customer->address)) $score++;
           
            if (!empty($this->customer->latitude) && !empty($this->customer->longitude)) {
                $score++;
            }
        }
        if (!empty($this->avatar)) {
            $score++;
        }

        if ($totalFields === 0) {
            return 100;
        }

        return floor(($score / $totalFields) * 100);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function worker(): HasOne
    {
        return $this->hasOne(Worker::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

     public function notifications()
    {
        return $this->hasMany(Notification::class)->latest(); 
    }
}
