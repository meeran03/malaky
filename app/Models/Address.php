<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'lat', 'long', 'title'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
