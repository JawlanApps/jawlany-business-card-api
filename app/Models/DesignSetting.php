<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'landing_background_image',
        'landing_title',
        'landing_subtitle',
        'menu_logo',
        'menu_background_color',
    ];

    protected $casts = [
        'landing_title' => 'array',
        'landing_subtitle' => 'array',
    ];
}

