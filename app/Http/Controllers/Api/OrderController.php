<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRateRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderStatusRequest;
use App\Http\Resources\OrderDeserve;
use App\Http\Resources\OrderResource;
use App\Http\Resources\Order as OrdersResource;
use App\Http\Resources\Child as ChildResource;
use App\Models\Activation;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Rate;
use App\Notifications\AccountNotification;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;

class OrderController extends Controller
{
    public $successStatus = 200;

    public function index(Request $request)
    {
        $user = Auth::user();
        if($user->type_id == 1 ){
            $orders = $user->userOrders;
        }else{
            $orders = $user->receiverOrders;
        }
        return response()->json(api_response( 1 , '' , OrdersResource::collection($orders) ), $this-> successStatus);
    }

    private function sorry($user , $order , $request)
    {
        if( ($user->type_id == 1 && $user->id != $order->user_id ) ||
            ($user->type_id == 2 && $user->id != $order->receiver_id )
        ){
            $msg = api_msg($request , 'نأسف لا يمكنك عرض الطلب' ,'Sorry, you cannot show a order.');
            return response()->json(api_response( 0 , $msg ), $this-> successStatus);
            
        }
    }
    public function show(Request $request)
    {
        $user = Auth::user();
        $order = Order::findOrFail($request->order_id);
        if(!empty($sorry = $this->sorry($user , $order , $request))){return $sorry;};
        return response()->json(api_response( 1 , '' , new OrderResource($order) ), $this-> successStatus);
    }

    public function add(OrderRequest $request)
    {
        $user = Auth::user();
        if(($user->type_id != 1) || $user->units ==0){
            $msg = api_msg($request , 'نأسف لا يمكنك اضافة طلب' ,'Sorry, you cannot nadd a order.');
            return response()->json(api_response( 0 , $msg ), $this-> successStatus);
            
        }
        $block = User::block($request , $user->id , $user->type_id);
        if(!empty($block)){ return $block;}
        $oldOrders = Order::where(['status_id'=>1 , 'user_id' => $user->id])->get();
        if($oldOrders){
            foreach ($oldOrders as $order){
                $order->update(['status_id'=>9]);
            }
        }
        $from = new DateTime($request->from);
        $to = new DateTime($request->to);
        $interval = (int) $from->diff($to)->format('%h');
        $data = $request->all();
        $data['user_id']    = $user->id;
        $data['units']      = $interval * count($request->children);
        $data['status_id']  =  1 ;
        if( $user->units < $data['units']){
            $msg = api_msg($request , 'نأسف الرصيد لا يسمح برجاء تجديد الباقة' ,'Sorry, the balance is not allowed. Please renew the package.');
            return response()->json(api_response( 0 , $msg ), $this-> successStatus);
            //return response()->json(['user' => $data]);
        }
        $order = Order::create($data);
        if ( is_array($request->children)  && count($request->children) >0){
            foreach ($request->children as $child){
                $order->items()->create (['children_id'=>$child]);
            }
        }
        $notify_ar = "تم إضافة طلب #" . $order->id;
        $notify_en = 'order has been added title #' . $order->id;
        $msg = api_msg($request , $notify_ar ,$notify_en);
        Notification::send($user, new AccountNotification( $notify_ar , $notify_en ,'orders' , $order->id));
        Notification::send($order->receiver, new AccountNotification( $notify_ar , $notify_en ,'orders' , $order->id));
        Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'orders' , $order->id ));
        $test2;
        if($order->receiver->device_token){
            $title = app_settings()->title;
            $content = 'طلب جديد';
            $message = ["data" => $msg];
            $test2 = fcm_notification($order->receiver->device_token, $content, $title, $message);
        }
        return response()->json(api_response( 1 , $msg , new OrderResource($order) ), $this-> successStatus);
        //return response()->json($order->receiver->device_token);https://fcm.googleapis.com/fcm/send
        //return response()->json(['meeran'=> $test2]);
        
    }

    public function coupon(Request $request)
    {
        $user = Auth::user();
        $app_coupon = Coupon::where(['title' => $request->coupon,'is_active' => 1 ])
            ->where('from' , '<=', Carbon::now())
            ->where('to' , '>=', Carbon::now())->first();
        if (isset($app_coupon) && $user->type_id == 1 && $user->is_active == 1 && empty($app_coupon->pastActive($user))) {
            $msg = api_msg($request , 'مبروك تم قبول الكوبون و اضافة رصيد '.$app_coupon->units ,'Congratulations, the coupon has been accepted and credit has been added '.$app_coupon->units);
            $user->increment('units' ,$app_coupon->units);
            Activation::updateOrCreate(['user_id' =>$user->id , 'coupon_id' =>$app_coupon->id ]);
            return response()->json(api_response( 1 , $msg ), $this-> successStatus);
        }
        $msg = api_msg($request , 'الكوبون الذي ادخلته غير صالح ' ,'The coupon you entered is incorrect');
        return response()->json(api_response( 0 , $msg ), $this-> successStatus);
    }

    public function children(Request $request)
    {
        $user = Auth::user();
        $order = Order::findOrFail($request->order_id);
        if(!empty($sorry = $this->sorry($user , $order , $request))){return $sorry;};
        return response()->json(api_response( 1 , '' , ChildResource::collection($order->children)), $this-> successStatus);
        //return response()->json(["Meeran"]);
    }

    function result($key , $request ,$order){
        if($key == 0){
            $notify_ar = "نأسف لا يمكنك استخدام هذه الحالة حاليا";
            $notify_en = 'Sorry, you cannot use this status currently';
            $msg = api_msg($request , $notify_ar ,$notify_en);
            return response()->json(api_response( $key , $msg), $this-> successStatus);
        }else{
            $order->update(['status_id'=>$request->status_id , 'reason'=>($request->status_id == 8) ? $request->reason : null ]);
            $notify_ar = "تم تعديل حالة الطلب إلى " . $order->status->translate('ar')->title;
            $notify_en = 'The order status is changed to ' . $order->status->translate('en')->title;
            $msg = api_msg($request , $notify_ar ,$notify_en);
            if($order->status_id == 11 || $order->status_id == 12 ){
                Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'orders' , $order->id ));
            }elseif($order->status_id == 3 || $order->status_id == 8){
                Notification::send($order->receiver, new AccountNotification( $notify_ar , $notify_en,'orders' , $order->id ));
            }elseif($order->status_id == 5 || $order->status_id == 7){
                Notification::send($order->user, new AccountNotification( $notify_ar , $notify_en,'orders' , $order->id ));
            }
            if(isset($order->user->device_token)){
                $title = app_settings()->title;
                $content = 'تحديث الطلب';
                $message = ["data" => $msg];
                fcm_notification($order->receiver->device_token, $content, $title, $message);
            }
            if(isset($order->receiver->device_token)){
                $title = app_settings()->title;
                $content = 'تحديث الطلب';
                $message = ["data" => $msg];
                fcm_notification($order->receiver->device_token, $content, $title, $message);
            }
            return response()->json(api_response( 1 , $msg , new OrderResource($order) ), $this-> successStatus);
        }
    }

    public function status(OrderStatusRequest $request)
    {
        $user = Auth::user();
        $order = Order::findOrFail($request->order_id);
        if(!empty($sorry = $this->sorry($user , $order , $request))){return $sorry;};
        $status = $request->status_id ;
        switch ($status) {
            case 1: $key = 0; break;
            case 2: ($user->type_id == 1 || $order->status_id != $status - 1)? $key = 0 : $key = 1 ; break;
            case 3:
                if($user->type_id == 1 && $order->status_id == $status - 1){
                    $key = 1 ;
                    $order->user()->decrement('units' ,$order->units);
                }else{
                    $key = 0 ;
                }
                ; break;
            case 4: ($user->type_id == 1 || $order->status_id != $status - 1)? $key = 0 : $key = 1 ; break;
            case 5:
                if($user->type_id == 1 || $order->status_id != $status - 1){
                    $key = 0;
                } else{
                    if($order->date == Carbon::today() &&  Carbon::now()->addMinutes(10)->format('H:i:s') > $order->to ){
                        $key = 1;
                        $order->user()->decrement('units' ,1);
                        $order->increment('units' ,1);
                    }else{
                        $key = 0;
                    }
                } ; break;
            case 6: ($user->type_id == 1 && ($order->status_id == 3||$order->status_id == 4 ||$order->status_id == 5) )? $key = 1 : $key = 0 ; break;
            case 7: ($user->type_id == 2 && $order->status_id <= 2)? $key = 1 : $key = 0 ; break;
            case 8: ($user->type_id == 1 && $order->status_id <= 3)? $key = 1 : $key = 0 ; break;
            case 9: $key = 0; break;
            default: $key = 0 ;
        }
        return $this->result($key , $request ,$order);
    }


    public function rate(OrderRateRequest $request)
    {
        $user = Auth::user();
        $order = Order::where(['id' => $request->order_id , 'user_id' =>$user->id] )->firstOrFail();
        if( ($order->status_id <= 4) ){
            $msg = api_msg($request , 'نأسف لا يمكنك تقييم الطلب حاليا' ,'Sorry, you cannot rate the order now.');
            return response()->json(api_response( 0 , $msg ), $this-> successStatus);
        }
        $data = $request->all();
        $data['order_id']    = $order->id ;
        $data['user_id']     = $order->user_id ;
        $data['receiver_id'] = $order->receiver_id ;
        $rate = $order->rate()->updateOrCreate([],$data);
        $rates = Rate::where('receiver_id' , $order->receiver_id )->avg('value');
        $order->receiver()->update(['rate'=>$rates]);
        $notify_ar = "تقييم الطلب " . $rate->value ;
        $notify_en = 'The rate of The Order ' . $rate->value;
        $msg = api_msg($request , $notify_ar ,$notify_en);
        Notification::send($order->receiver, new AccountNotification( $notify_ar , $notify_en ,'orders' ,$order->id));
        return response()->json(api_response( 1 , $msg ), $this-> successStatus);
    }

    public function current(Request $request)
    {
        $user = Auth::user();
        if($user->type_id == 1){
            $order = Order::where('status_id' , '<' , 6)->where('user_id',$user->id)->where('date',Carbon::today())->latest()->firstOrfail();
        }else{
            $order = Order::where('status_id' , '<' , 6)->where('receiver_id',$user->id)->where('date',Carbon::today())->latest()->firstOrfail();
        }
        return response()->json(api_response( 1 , '' , new OrderResource($order) ), $this-> successStatus);
    }
}
