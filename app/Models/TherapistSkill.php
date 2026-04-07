<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapistSkill extends Model
{
    use HasFactory;

    protected $fillable = ['therapist_id', 'skill_name', 'level'];

    public function therapist()
    {
        return $this->belongsTo(Therapist::class);
    }

}