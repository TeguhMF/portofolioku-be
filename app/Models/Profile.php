<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'username',
        'school_name',
        'grade_level',
        'career_goal',
        'bio',
        'phone_whatsapp',
        'avatar_url',
        'social_linkedin',
        'social_github',
        'social_instagram',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}