<?php

namespace App\Models;

use App\User;
use App\Models\Subscription;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Package extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = [ 'title', 'feature_1', 'feature_2', 'feature_3', 'feature_4'];
    protected $fillable = [
        'type_id', 'units', 'price', 'is_active'
    ];

    public function getIsActiveTxtAttribute()
    {
        if($this ->is_active == 0 ){
            $txt = '<span class="badge badge-pill badge-warning"> غير مفعل </span>';
        }else{
            $txt = '<span class="badge badge-pill badge-success">  مفعل </span>';
        }
        return $txt;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
