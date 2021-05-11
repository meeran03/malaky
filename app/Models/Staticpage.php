<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staticpage extends Model
{
    public $translatedAttributes = ['title', 'content', 'excerpt', 'slug', 'images'];
    protected $fillable = [
        'is_active'
    ];


    public function trans($locale = 'ar'){
        return $this->hasMany(StaticpageTranslation::class)->where('locale',$locale)->first();
    }

    public function transes(){
        return $this->hasMany(StaticpageTranslation::class);
    }
    public function getIsActiveTxtAttribute()
    {
        if ($this->is_active == 0) {
            $txt = '<span class="badge badge-pill badge-warning"> غير مفعل </span>';
        } else {
            $txt = '<span class="badge badge-pill badge-success">  مفعل </span>';
        }
        return $txt;
    }

    public function getImagePathAttribute()
    {
        if (empty($this->image)) {
            $txt = asset('adminpanel/assets/images/default1.jpg');
        } else {
            $txt = asset($this->image);
        }
        return $txt;
    }
}
