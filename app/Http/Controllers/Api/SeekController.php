<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeekRequest;

use App\Models\Seek;
use App\Notifications\AccountNotification;
use Notification;

class SeekController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 400;

    public function storeImg($request)
    {
        $file = $request->file('attach');
        if ($file) {
            $filepath = 'images/seeks/'.date('Y').'/'.date('m').'/';
            $filename = $filepath.time().'-'.strtolower(preg_replace('/\s+/', '-', $file->getClientOriginalName()));
            $file->move($filepath, $filename);
        } else {
            $filename =  null;
        }

        return $filename;
    }

    public function index(SeekRequest $request)
    {
        $data = $request->except( 'image');
        $data['attach'] = $this->storeImg($request);
        $notify_ar = 'تم استلام طلب خدمة' ;
        $notify_en = 'A service request has been received';
        $msg = api_msg($request , $notify_ar , $notify_en);
        $seek = Seek::updateOrCreate($data);
        Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'seeks' , $seek->id ));
        return response()->json(api_response( 1 , $msg ), $this-> successStatus);
    }
}
