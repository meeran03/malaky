<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Setting extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title', 'description'];

    protected $fillable = [
        'maintenance', 'logo', 'copyrights', 'currency', 'currency_dollar',
        'address', 'phone', 'phone2', 'whatsapp', 'email', 'map', 'facebook', 'twitter', 'linkedin',
        'youtube', 'snapchat', 'instagram', 'appstore', 'googleplay'
    ];

    public function getImagePathAttribute()
    {
        if (empty($this->logo)) {
            $txt = asset('images/settings/logo1.png');
        } else {
            $txt = asset($this->logo);
        }
        return $txt;
    }
}
