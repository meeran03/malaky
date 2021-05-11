<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'package_id', 'price', 'units' , 'pay_id' , 'transaction_id'
    ];
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
