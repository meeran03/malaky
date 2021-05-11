<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Status extends Model implements TranslatableContract
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

    public function getStatusTxtAttribute()
    {
        switch ($this->id) {
            case 1 :
                $txt = 'info';
                break;
            case 2 :
                $txt = 'dark';
                break;
            case 3 :
                $txt = 'orange';
                break;
            case 4 :
                $txt = 'purple';
                break;
            case 5 :
                $txt = 'danger';
                break;
            case 6 :
                $txt = 'success';
                break;
            case 7 :
                $txt = 'cyan';
                break;
            case 8 :
                $txt = 'secondary';
                break;
            case 9 :
                $txt = 'warning';
                break;
            default :
                $txt = 'info';
        }
        return $txt;
    }
}
