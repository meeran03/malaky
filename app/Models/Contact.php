<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id', 'name', 'phone', 'type', 'message', 'reply' ,'email'
    ];

    public function getIsRepliedTxtAttribute()
    {
        if ($this->reply == null) {
            $txt = '<span class="badge badge-pill badge-warning"> لم يتم الرد </span>';
        } else {
            $txt = '<span class="badge badge-pill badge-success"> تم الرد </span>';
        }
        return $txt;
    }

    public function getTypeTxtAttribute()
    {
        if ($this->type == 'contact') {
            $txt = '<span class="badge badge-pill badge-info">اتصل بنا</span>';
        } else {
            $txt = '<span class="badge badge-pill badge-danger">شكوى</span>';
        }
        return $txt;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
