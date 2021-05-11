<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    protected $fillable = [
        'user_id', 'coupon_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
