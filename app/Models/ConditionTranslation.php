<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConditionTranslation extends Model
{
    protected $fillable = [
        'condition_id', 'locale', 'title'
    ];
}
