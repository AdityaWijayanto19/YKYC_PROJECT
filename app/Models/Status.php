<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function getBadgeHtml()
    {
        $statusName = strtolower($this->name);
        $class = 'text-gray-800 bg-gray-100'; 

        if (in_array($statusName, ['completed', 'selesai'])) $class = 'text-green-800 bg-green-100';
        elseif (in_array($statusName, ['diproses', 'on-the-way', 'in progress'])) $class = 'text-amber-800 bg-amber-100';
        elseif (in_array($statusName, ['cancelled', 'dibatalkan'])) $class = 'text-red-800 bg-red-100';
        elseif (in_array($statusName, ['pending', 'waiting', 'baru'])) $class = 'text-blue-800 bg-blue-100';

        return "<span class='text-sm {$class} px-3 py-1 rounded-full font-semibold'>" . e(ucfirst($this->label)) . "</span>";
    }                                                   
}
