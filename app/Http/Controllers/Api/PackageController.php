<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeRequest;
use App\Http\Resources\Package as PackageResource;
use App\Models\Package;
use App\Models\Subscription;
use App\Notifications\AccountNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;

class PackageController extends Controller
{
    public $successStatus = 200;
    public function index()
    {
        $user = Auth::user();
        $packages = Package::where( ['type_id'=>$user->type_id , 'is_active' => 1 ] )->get();
        return response()->json( PackageResource::collection($packages),$this->successStatus);
    }

    public function subscribe(SubscribeRequest $request)
    {
        $user = Auth::user();
        $package = Package::where([ 'id' => $request->package_id , 'type_id'=>$user->type_id , 'is_active' => 1 ])->first();
        if( $request->payed == 0  || empty($package) || $request->price < $package->price){
            $msg = api_msg($request , 'نأسف لأ يمكن تجديد الباقة رجاء المحاولة في وقت لاحق' ,'We are sorry that the package cannot be renewed please try again later');
            return response()->json(api_response( 0 , $msg ), $this-> successStatus);
        }
        $subscribe = Subscription::create([
            'user_id'        => $user->id ,
            'package_id'     => $package->id,
            'price'          => $request->price,
            'units'          => $package->units ,
        ]);
        $user ->increment('units'  , $subscribe->units );
        $notify_ar = "تم إضافة رصيد الباقة بنجاح " ;
        $notify_en = 'The package balance added successfully ';
        $msg = api_msg($request , $notify_ar ,$notify_en);
        Notification::send($user, new AccountNotification($notify_ar , $notify_en ));
        return response()->json(api_response( 1 , $msg ), $this-> successStatus);
    }
}
