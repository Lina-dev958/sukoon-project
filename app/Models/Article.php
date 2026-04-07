<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['therapist_id', 'title', 'excerpt', 'content', 'image'];

    public function therapist()
    {
        return $this->belongsTo(Therapist::class);
    }
}