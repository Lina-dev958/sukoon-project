<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'active' => 'boolean', 
    ];

    // العلاقة مع جدول Therapist
   // User.php
    public function therapist()
    {
        return $this->hasOne(Therapist::class, 'user_id'); // تأكدي من اسم المفتاح الخارجي
    }
   

    public function journals()
{
    return $this->hasMany(\App\Models\Journal::class);
}
public function moods()
{
    return $this->hasMany(Mood::class);
}
public function patient()
{
    return $this->hasOne(Patient::class);
}
public function bookings()
{
return $this->hasMany(Booking::class);
}
}