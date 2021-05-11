<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryRequest;
use App\Models\Delivery;
use App\Notifications\AccountNotification;
use Illuminate\Http\Request;
use Notification;

class DeliveryController extends Controller
{
    public $successStatus = 200;

    public function create(DeliveryRequest $request)
    {
        $data = $request->all();
        $delivery = Delivery::updateOrCreate($data);
        $notify_ar = 'تم إستلام طلب مندوب بنجاح';
        $notify_en = 'A Delivery Request has been received Successfully';
        $msg = api_msg($request , $notify_ar ,$notify_en);
        Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'deliveries' , $delivery->id ));
        return response()->json(api_response( 1 , $msg), $this-> successStatus);
    }
}
