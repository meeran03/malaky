<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $fillable = [
        'user_id', 'title', 'years', 'months', 'medicine', 'notes', 'is_active'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class,'items', 'children_id' , 'order_id');
    }

    public function getIsActiveTxtAttribute()
    {
        if ($this->is_active == 3) {
            $txt = '<span class="badge badge-pill badge-danger"> محذوف </span>';
        } else {
            $txt = '<span class="badge badge-pill badge-success">  مفعل </span>';
        }
        return $txt;
    }

    public function getMedicineTxtAttribute()
    {
        if ($this->medicine == 0) {
            $txt = '<span class="badge badge-pill badge-primary"> لا يوجد </span>';
        } else {
            $txt = '<span class="badge badge-pill badge-warning">  يوجد </span>';
        }
        return $txt;
    }
}
