<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\PageResource ;
use App\Http\Resources\Slider as SliderResource;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Slider;
use App\Notifications\AccountNotification;
use Illuminate\Http\Request;
use Notification;

class PageController extends Controller
{
    public $successStatus = 200;
    public function index($id)
    {
        $page = Page::where([ 'id' => $id , 'is_active' => 1 ])->firstOrFail();
        return response()->json(api_response( 1 , '' , new PageResource($page)), $this-> successStatus);
    }

    public function contactUs(ContactRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user('api') ? $request->user('api')->id : null;
        $contact = Contact::updateOrCreate($data);
        $type_en = $contact->type ;
        $type_ar = ($contact->type == 'contact') ? ' اتصل بنا ' : ' شكوى ';
        $notify_ar = 'تم إستلام رسالة '.$type_ar.' بنجاح';
        $notify_en = 'A '.$type_en.' has been received  Successfully';
        $msg = api_msg($request , $notify_ar ,$notify_en);
        Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'contacts' , $contact->id ));
        return response()->json(api_response( 1 , $msg), $this-> successStatus);
    }

    public function fallBack()
    {
        return response()->json(api_response( 0 ,'Not Found!' ));
    }

    public function sliders()
    {
        $sliders = Slider::where('is_active',1)->latest()->take(10)->get();
        $res = api_response( 1 , '' , SliderResource::collection($sliders));        
        return response()->json($res, $this-> successStatus);
    }
}
