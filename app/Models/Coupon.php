<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'title', 'units', 'from', 'to', 'is_active'
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

    public function pastActive($user)
    {
        return Activation::where(['user_id'=>$user->id , 'coupon_id'=>$this->id])->first();
    }
}
