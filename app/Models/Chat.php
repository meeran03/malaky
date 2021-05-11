<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id'
    ];

    public function user()
    {
        $user = Auth::user();
//        if($user -> type_id == 1 ){ $type = 'sender_id' ; }else{$type = 'receiver_id';}
        if($user -> type_id == 1 ){ $type = 'receiver_id' ; }else{$type = 'sender_id';}
        return $this->belongsTo(User::class , $type);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function chatReciever()
    {
        return $this->belongsTo(User::class , 'receiver_id');
    }

    public function chatSender()
    {
        return $this->belongsTo(User::class , 'sender_id');
    }
}
