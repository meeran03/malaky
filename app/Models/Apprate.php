<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Apprate extends Model
{
    protected $fillable = [
        'user_id', 'value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
