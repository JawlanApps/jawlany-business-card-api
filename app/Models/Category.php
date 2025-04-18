<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'cover_picture', 'icon', 'background_picture'];

    // Force-cast manually since MariaDB stores JSON as longtext
    protected $casts = [
        'name' => 'array',
    ];

    public function getNameAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value, true);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'card_categories');
    }
}
