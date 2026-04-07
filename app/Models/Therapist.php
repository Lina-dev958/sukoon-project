<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'job_title', 'phone', 'image', 
        'certificate_file', 'location', 'experience_years', 
        'verification_status'
    ];

    protected $casts = [
        'interests' => 'array',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    public function skills()
{
    return $this->hasMany(TherapistSkill::class);
}

    // لو عندك specialties أو اهتمامات
    // public function specialties()
    // {
    //     return json_decode($this->specialties ?? '[]', true);
    // }
    public function specialties()
{
    return $this->belongsToMany(Specialty::class, 'therapist_specialty', 'therapist_id', 'specialty_id');
}
public function articles()
{
    return $this->hasMany(Article::class);
}
public function bookings()
{
return $this->hasMany(Booking::class);
}
}
