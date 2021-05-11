<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    public static function Hyperpay($amount , $user_id , $user_email , $user_name , $transaction_id , $type = "visa")
    {
        $token = env('HYPERPAY_TOKEN');
        if($type == 'visa'){
            $entityId = env('HYPERPAY_ENTITYID_VISA');
        } else{
            $entityId =  env('HYPERPAY_ENTITYID_MADA');
        }
        $currency = 'SAR';
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=".$entityId .
            "&amount=".$amount .
            "&currency=".$currency .
            "&paymentType=DB".
//            "&testMode=EXTERNAL".
            "&merchantTransactionId=".$transaction_id.
            "&customer.email=".$user_email.
            "&billing.street1=street".
            "&billing.city=city".
            "&billing.state=state".
            "&billing.country=SA".
            "&billing.postcode=11564".
            "&customer.givenName=".$user_name.
            "&customer.surname=".$user_name;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '.$token));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData);
    }

    public static function CheckRequired($request , $user_id , $package_id){
        if(!isset($user_id) || !isset($package_id) ){
            $notify_ar = "رجاء إكمال البيانات الضرورية";
            $notify_en = 'Please complete the necessary information';
            $msg = api_msg($request , $notify_ar , $notify_en);
            return ['status' => 0 , 'msg' => $msg];
        }else{
            $user = User::find($user_id);
            $package = Package::find($package_id);
            if(!isset($user) || !isset($package) ) {
                $notify_ar = "البيانات الواردة غير صحيحة";
                $notify_en = 'The data provided is incorrect';
                $msg = api_msg($request, $notify_ar, $notify_en);
                return ['status' => 0, 'msg' => $msg];
            }else{
                return [
                    'status'    => 1 ,
                    'msg'       => 'success',
                    'amount'    => $package->price ,
                    'user_id'   => $user->id ,
                    'user_email'=> $user->email ?? 'info@domain.com' ,
                    'user_name' => $user->name
                ];
            }
        }
    }

    public static function CheckData($request , $pay){
//        dd($pay);
        if(!isset($pay) || $pay->result->code  !== '000.200.100'){
            $notify_ar = "نأسف لا يمكنك اتمام عملية الدفع";
            $notify_en = 'Sorry, you cannot complete the payment';
            $msg = api_msg($request , $notify_ar , $notify_en);
            return ['status' => 0 , 'msg' => $msg];
        }else{
            return ['status' => 1, 'msg' => 'success'];

        }
    }

    public static function result($resourcePath , $type = "visa")
    {
        $token = env('HYPERPAY_TOKEN');
        if($type == 'visa'){
            $entityId = env('HYPERPAY_ENTITYID_VISA');
        } else{
            $entityId =  env('HYPERPAY_ENTITYID_MADA');
        }
        $url = "https://test.oppwa.com".$resourcePath;
        $url .= "?entityId=".$entityId;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '.$token));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData);
    }
}
