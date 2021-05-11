<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    protected $fillable = [
        'slider_id', 'locale', 'title', 'slug', 'excerpt', 'content', 'image'
    ];
}
