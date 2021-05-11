<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'user_id', 'phone', 'phone_verified_at', 'verification_code'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
