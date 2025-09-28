<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class  User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Menghitung dan mengembalikan persentase kelengkapan profil.
     *
     * @return int
     */
    public function getProfileCompletionPercentageAttribute(): int
    {
        $score = 0;
        // Tentukan ada berapa field yang kita hitung
        $totalFields = 4;

        // Beri 1 poin untuk setiap field yang tidak kosong
        if (!empty($this->name)) {
            $score++;
        }
        if (!empty($this->number_phone)) {
            $score++;
        }
        if ($this->customer && !empty($this->customer->address)) {
            $score++;
        }
        if (!empty($this->avatar)) {
            $score++;
        }

        // Hitung persentase dan bulatkan ke bawah
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
}
