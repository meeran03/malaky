<?php

namespace App;

use App\Models\Address;
use App\Models\Children;
use App\Models\City;
use App\Models\Country;
use App\Models\Image;
use App\Models\Nationality;
use App\Models\Order;
use App\Models\Package;
use App\Models\Phone;
use App\Models\Rate;
use App\Models\Subscription;
use App\Models\Type;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'country_id', 'city_id', 'birthday', 'nationality_id',
        'gender', 'privacy', 'rate', 'image', 'type_id', 'address', 'bio', 'units', 'is_active', 'phone_verified_at',
        'verification_code', 'emergency', 'email_verified_at', 'device_token', 'device_type' ,'ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsActiveTxtAttribute()
    {
        if ($this->is_active == 0) {
            $txt = '<span class="badge badge-pill badge-warning"> غير مفعل </span>';
        } else {
            $txt = '<span class="badge badge-pill badge-success">  مفعل </span>';
        }
        return $txt;
    }

    public function getImagePathAttribute()
    {
        if (empty($this->image)) {
            $txt = asset('adminpanel/assets/images/user.jpg');
        } else {
            $txt = asset($this->image);
        }
        return $txt;
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function currentAddress(){
        return $this->hasOne(Address::class);
    }

    public function AauthAcessToken()
    {
        return $this->hasMany(OauthAccessToken::class);
    }

    public function accessTokens()
    {
        return $this->hasMany('App\OauthAccessToken');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function receiverRates()
    {
        return $this->hasMany(Rate::class, 'receiver_id');
    }

    public function userOrders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function receiverOrders()
    {
        return $this->hasMany(Order::class, 'receiver_id');
    }

    public function getOrdersCountAttribute()
    {
        $user = Auth::user();
        if ($user) {
            if ($user->type_id == 1) {
                $count = $this->userOrders()->where('status_id', 7)->count();
            } else {
                $count = $this->receiverOrders()->where('status_id', 7)->count();
            }
        } else {
            $count = 0;
        }
        return $count;
    }
    public function newPhone()
    {
        return $this->hasOne(Phone::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function Children()
    {
        return $this->hasMany(Children::class);
    }

    public static function block($request , $user_id ,$type_id)
    {
        $user = User::findOrFail($user_id);
//        if ($user->type_id !== $type_id ||  $user->is_active !== 1 ){
//            $msg = api_msg($request , 'نأسف هذا الرابط غير متاح' ,'Sorry, this link is not available');
//            return response()->json(api_response( 0 , $msg ), 200);
//        }
        if ($user->type_id !== $type_id  ){
            $msg = api_msg($request , 'نأسف هذا الرابط غير متاح' ,'Sorry, this link is not available');
        }elseif ($user->is_active == 0){
            $msg = api_msg($request , 'هذا العضو غير مفعل' ,'This member is not activated');
        }elseif ($user->is_active > 1){
            $msg = api_msg($request , 'هذا العضو موقوف من الإدارة' ,'This member is suspended from management');
        }
        if(!empty($msg)){
            return response()->json(api_response( 1 , $msg ,['is_active'=>$user->is_active]), 200);
        }
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class ,'user_id')->latest();
    }
}
