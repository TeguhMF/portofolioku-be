<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke Profil
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Relasi ke Prestasi
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    // Relasi ke Organisasi (Wajib Ada)
    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    // Relasi ke Karya
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Relasi ke Keahlian
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function builderSetting()
    {
        return $this->hasOne(BuilderSetting::class);
    }
}