<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model
{
    protected $fillable = [
        'package_id', 'locale', 'title', 'feature_1', 'feature_2', 'feature_3', 'feature_4'
    ];
}
