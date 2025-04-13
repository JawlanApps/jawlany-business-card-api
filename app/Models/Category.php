<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'cover_picture', 'icon'];

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'card_categories');
    }
}
