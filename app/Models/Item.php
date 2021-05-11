<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'order_id', 'children_id'
    ];

    public function children()
    {
        return $this->belongsTo(Children::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
