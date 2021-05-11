<?php

namespace App\Models;

use App\Events\OrdersEvent;
use App\Events\OrderSingleEvent;
use App\Http\Resources\OrderEvent;
use App\Http\Resources\Offer as OfferResource;
use App\Http\Resources\OrderResource;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'receiver_id', 'units', 'date', 'from', 'to', 'details', 'reason', 'status_id'
    ];
    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function children()
    {
        return $this->belongsToMany(Children::class,'items', 'order_id' , 'children_id');
    }

    public function rate()
    {
        return $this->hasOne(Rate::class);
    }

    public function getStatusTxtAttribute()
    {
        switch ($this->status_id) {
            case 1 :
                $txt = 'info';
                break;
            case 2 :
                $txt = 'dark';
                break;
            case 3 :
                $txt = 'orange';
                break;
            case 4 :
                $txt = 'purple';
                break;
            case 5 :
                $txt = 'danger';
                break;
            case 6 :
                $txt = 'success';
                break;
            case 7 :
                $txt = 'cyan';
                break;
            case 8 :
                $txt = 'secondary';
                break;
            case 9 :
                $txt = 'warning';
                break;
            default :
                $txt = 'info';
        }
        return $txt;
    }
}
