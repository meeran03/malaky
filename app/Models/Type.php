<?php

namespace App\Models;

use App\User;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Type extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['title'];
    protected $fillable = [
    'balance', 'is_active'
];
    protected $hidden = ['created_at','updated_at'];
    public $timestamps = false;

    public function users(){
        return $this->hasMany(User::class);
    }

    public function packages(){
        return $this->hasMany(Package::class);
    }
}
