<?php

namespace App\Models;

use App\Notifications\AccountNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Notification;

class SendSms extends Model
{
    public static function Send($RecepientNumber , $Message )
    {
        if( !empty(env("SMS_USERNAME")) &&  !empty(env("SMS_PASSWORD")) && !empty(env("SMS_TAGNAME")) ){
            $response = Http::post('http://api.yamamah.com/SendSMSV3', [
                "Username"          => env("SMS_USERNAME"),
                "Password"          => env("SMS_PASSWORD"),
                "Tagname"           => env("SMS_TAGNAME"),
                "RecepientNumber"   => $RecepientNumber,
                "VariableList"      => "0",
                "ReplacementList"   => "",
                "Message"           => $Message ,
                "SendDateTime"      => "0",
                "EnableDR"          => false ,
                "SentMessageID"     => true
            ]);
            $response = json_decode($response)  ;
            $result['status'] = $response->Status;
            $result['StatusDescription'] = $response->StatusDescription;;
            if($response->Status == 40 ){
                $notify_ar = 'تم إنتهاء رصيد باقة الرسائل يرجي التجديد';
                $notify_en = 'The SMS bundle balance has expired. Please renew';
                Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'settings' , '' ));
                $result['ar'] = $notify_ar;
                $result['en'] = $notify_en;
            }else{
                $result['ar'] = 'تم ارسال الرسالة بنجاح';
                $result['en'] = 'SMS Sent Successfully';
            }
            return $result;
        }
    }
}
