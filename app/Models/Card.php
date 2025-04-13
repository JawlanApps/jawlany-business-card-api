<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'sub_name', 'whatsapp', 'email', 'phone', 'website',
        'address', 'social_media', 'profile_picture', 'cover_picture',
        'theme_color', 'background_color'
    ];

    protected $casts = [
        'social_media' => 'array',
    ];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'card_categories');
    }
}
