<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Booking; // Added this line to import the Booking model
use App\Models\Notification; // Added this line to import the Notification model

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'sport_interest',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'sport_interest' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
