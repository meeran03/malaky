<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticpageTranslation extends Model
{
    protected $fillable = [
        'staticpage_id', 'locale', 'title', 'content', 'excerpt', 'slug', 'images'
    ];
}
