<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuilderSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template',
        'accent_color',
        'font_family',
        'section_order',
        'is_draft',
    ];

    protected $casts = [
        'section_order' => 'array',
        'is_draft' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}