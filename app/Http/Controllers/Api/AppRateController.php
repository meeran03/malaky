<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppRateRequest;
use App\Models\Apprate;
use App\Notifications\AccountNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;

class AppRateController extends Controller
{
    public $successStatus = 200;
    public function index(AppRateRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $rate = Apprate::updateOrCreate([],$data);
        $notify_ar = "تم تقييم التطبيق بنجاح برقم " . $rate->value ;
        $notify_en = 'The application was evaluated successfully with a value ' . $rate->value;
        $msg = api_msg($request , $notify_ar ,$notify_en);
        Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'apprates' , $rate->id ));
        return response()->json(api_response( 1 , $msg ), $this-> successStatus);
    }
}
