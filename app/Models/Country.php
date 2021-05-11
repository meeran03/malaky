<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'code', 'title_en', 'title_ar', 'nationality_en', 'nationality_ar'
    ];
    protected $hidden = ['created_at','updated_at'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
