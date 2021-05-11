<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'is_active' , 'start_date','end_date'
    ];
    public function getIsActiveTxtAttribute()
    {
        if ($this->is_active == 0) {
            $txt = '<span class="badge badge-pill badge-warning"> لم يستلم </span>';
        } else {
            $txt = '<span class="badge badge-pill badge-success">  تم الإستلام </span>';
        }
        return $txt;
    }
}
