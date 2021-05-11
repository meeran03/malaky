<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Translatable;
    public $translatedAttributes = ['title'];
    protected $fillable = [
        'is_active'
    ];

    public function getIsActiveTxtAttribute()
    {
        if ($this->is_active == 0) {
            $txt = '<span class="badge badge-pill badge-warning"> غير مفعل </span>';
        } else {
            $txt = '<span class="badge badge-pill badge-success">  مفعل </span>';
        }
        return $txt;
    }
}
