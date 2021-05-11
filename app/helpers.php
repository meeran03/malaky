<?php

use App\Models\Language;
use App\Models\Page;
use App\Models\Setting;
use App\User;
use Illuminate\Support\Facades\App;

    function app_languages()
    {
        $languages = Language::all('id','title','code')->toArray();
        return $languages;
    }

    function app_admins()
    {
        $admins = User::whereHas("roles", function($q){ $q->where("name", "admin"); })->get();
        return $admins;
    }
    function app_settings(){
        return Setting::find(1);
    }
    function app_workers()
    {
        $workers = User::where(['type' => "worker" , 'is_active' => 1 ])->get();
        return $workers;
    }
    function api_response( $status , $msg = '' , $data = [])
    {
        if ( $data == [] ){
            return ['status'  => $status ,
                    'message' => $msg ,
            ];
        }
        return ['status'  => $status ,
                'message' => $msg ,
                'data'    => $data
                ];
    }

    function api_msg($request , $ar , $en ){
        if($request->header('Accept-Language')=="ar"){
            $msg = $ar;
        }else{
            $msg = $en;
        }
        return $msg ;
    }

    function api_notify( $ar = '' , $en = '' , $url = '')
    {
        return [
            'ar' => $ar ,
            'en' => $en,
            'url' => $url ,
            'notify_id' => random_int(1000000, 9999999)
        ];
    }

    function api_lang()
    {
        if(request()->header('Accept-Language') && request()->wantsJson()){ App::setLocale(request()->header('Accept-Language'));}
    }

    function admin_can_any($table)
    {
        $user = auth()->user();
        return $user->can ($table.' read') || $user->can ($table.' create') || $user->can ($table.' update') || $user->can ($table.' delete') ;
    }
    function fcm_notification($token, $content, $title, $message)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $notification = [
            'notification' => $message,
            'sound' => true,
            'title' => $title,
            'body' => $content,
            'priority' => 'high',
        ];

        $extraNotificationData = ["data" => $notification];

        $fcmNotification = [
            'to' => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=AAAAKih7FxQ:APA91bGkdPgsUFmVZsPxGcP_jvwBDvskBiMp1zYw24jiV6BD1-gm6Tx8wSjT0ns__hDRAysqKf-C1j639NzfbWqePmsAk2tKddH_w8CRYTVcp0S-oZz6dmi6uQ0C7ceypM_WDFhQ5d-t', //.env('FCM_SERVER_KEY')
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
        //return true;
        return $result;
    }
        function app_privacy()
        {
            $privacy = Page::where(['id'=>3, 'is_active'=>1 ])->first();
            return $privacy;
        }




