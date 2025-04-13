<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardCategory extends Model
{
    use HasFactory;

    protected $table = 'card_categories';

    protected $fillable = ['card_id', 'category_id'];

    public $timestamps = false;

    public function card(){
        return $this->belongsTo(Card::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
