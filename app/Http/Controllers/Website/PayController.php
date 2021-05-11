<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Package;
use App\Models\Pay;
use App\Models\Subscription;
use App\Notifications\AccountNotification;
use App\User;
use Illuminate\Http\Request;
use Notification;
use Throwable;

class PayController extends Controller
{

    public function pay(Request $request)
    {
        $user_id = $request->user_id;
        $package_id = $request->package_id;
        $type = in_array($request->type , ['visa','mada']) ? $request->type : 'visa';
        $checkRequired = Pay::CheckRequired($request , $user_id , $package_id);
        if($checkRequired['status'] == 0 ){return redirect('/pay/error')->with('error',$checkRequired['msg']);}
        $transaction_id = random_int(100000,999999);
        $pay = Pay::Hyperpay($checkRequired['amount'] , $checkRequired['user_id'] , $checkRequired['user_email'] , $checkRequired['user_name'] , $transaction_id , $type );
        $checkRequired = Pay::CheckData($request , $pay);
        if($checkRequired['status'] == 0 ){return redirect('/pay/error')->with('error',$checkRequired['msg']);}
        $checkoutId = $pay->id;
        $lang = session()->get('locale') ?? 'ar';
        return view('website.pay.form' , [ 'lang' => $lang , 'checkoutId'=>$checkoutId , 'user_id'=>$user_id , 'package_id'=>$package_id , 'type' =>$type , 'transaction_id'=>$transaction_id]);
    }

    public function result(Request $request)
    {
        $type = in_array($request->type , ['visa','mada']) ? $request->type : 'visa';
        $result = Pay::result($request->resourcePath , $type);
        $success = ['000.000.000','000.400.000','000.400.010','000.400.020','000.400.040','000.400.060','000.400.090' ,
//            next test mode
            '000.100.110','000.100.111','000.100.112'];
        if(isset($result) && in_array($result->result->code ,$success)){
            $user = User::find($request->user_id);
            $package = Package::find($request->package_id);
            $subscribe = Subscription::create([
                'user_id'        => $user->id ,
                'package_id'     => $package->id,
                'price'          => $package->price,
                'units'          => $package->units ,
                'pay_id'         => $request->id ,
                'transaction_id' => $request->transaction_id ,
            ]);
            $user ->increment('units'  , $subscribe->units );
            $notify_ar = "تم إضافة رصيد الباقة بنجاح " ;
            $notify_en = 'The package balance added successfully ';
            $msg = api_msg($request , $notify_ar ,$notify_en);
            Notification::send($user, new AccountNotification($notify_ar , $notify_en ,'subscriptions',$subscribe->id));

            $notify_ar = "تم الإشتراك في باقة بنجاح";
            $notify_en = 'The package has been subscribed successfully';
            Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'subscriptions' ,$subscribe->id));
            return redirect('/pay/success')->with('success',$msg);
        }else{
            $msg = api_msg($request , 'نأسف لأ يمكن تجديد الباقة رجاء المحاولة في وقت لاحق' ,'We are sorry that the package cannot be renewed please try again later');
            return redirect('/pay/error')->with('error',$msg);
        }
    }

    public function finish()
    {
        $lang = session()->get('locale') ?? 'ar';
        return view('website.pay.result' , [ 'lang' => $lang]);
    }
}
