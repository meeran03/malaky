<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apptable extends Model
{
    protected $fillable = [
        'title', 'title_en', 'is_active'
    ];
}
