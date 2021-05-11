<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChildRequest;
use App\Models\Children;
use App\Http\Resources\Child as ChildResource;
use App\Notifications\AccountNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;

class ChildrenController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 400;

    public function index()
    {
        $user = Auth::user();
        $children = $user->children()->whereIsActive(1)->get();
        return response()->json(api_response( 1 , '' , ChildResource::collection($children)), $this-> successStatus);
    }
    public function add( ChildRequest $request)
    {
        $user = Auth::user();
        $block = User::block($request , $user->id , 1);
        //if(!empty($block)){return $block;}
        $data = $request->all();
        $user->children()->updateOrCreate($data);
        $children = $user->children()->whereIsActive(1)->get();
        $notify_ar = "تم إضافة الملاك بنجاح ";
        $notify_en = 'Angel has been added successfully';
        $msg = api_msg($request, $notify_ar, $notify_en);
        Notification::send($user, new AccountNotification( $notify_ar, $notify_en));
        //return response()->json(["msg" => "Good"]);
        return response()->json(api_response( 1 , $msg , ChildResource::collection($children)), $this-> successStatus);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $child = Children::where(['user_id'=>$user->id,'id'=>$request->id,'is_active'=>1])->firstOrFail();
        if(empty($child->orders->first())){
            $child->delete();
        }else{
            $child->update(['is_active'=>3]);
        }
        $children = $user->children()->whereIsActive(1)->get();
        $notify_ar = 'تم حذف بيانات الملاك بنجاح' ;
        $notify_en = 'The Angel data deleted successfully';
        $msg = api_msg($request, $notify_ar, $notify_en);
        Notification::send($user, new AccountNotification( $notify_ar, $notify_en));
        return response()->json(api_response( 1 , $msg , ChildResource::collection($children)), $this-> successStatus);
    }
}
