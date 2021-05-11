<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'name', 'phone', 'is_active'
    ];

    public function getIsActiveTxtAttribute()
    {
        if ($this->is_active == 0) {
            $txt = '<span class="badge badge-pill badge-info"> في الإنتظار </span>';
        } else if ($this->is_active == 1) {
            $txt = '<span class="badge badge-pill badge-success">  تم التواصل </span>';
        } else {
            $txt = '<span class="badge badge-pill badge-danger"> مرفوض </span>';
        }
        return $txt;
    }
}
