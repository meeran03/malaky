<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use http\Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingController extends Controller
{
    function __construct() {
        $this->middleware('can:settings read')->only(['index', 'show']);
        $this->middleware('can:settings create')->only(['create','store']);
        $this->middleware('can:settings update')->only(['edit','update']);
        $this->middleware('can:settings delete')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::find(1);
        try {
            $response = Http::post('http://api.yamamah.com/GetCredit/'.env("SMS_USERNAME").'/'.env("SMS_PASSWORD"));
            $response = json_decode($response)  ;
            if ( isset($response->GetCreditPostResult)){
                $credit = $response->GetCreditPostResult->Credit;
            }else {
                $credit = 0;
            }
        } catch (Exception $e) {
            $credit = 0;
        }
        return view('admin.settings',['settings' => $settings , 'credit' => $credit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $setting = Setting::findOrFail(1);
        $old_image = $setting->logo;
        if($request->hasfile('logo')){
            $file = $request->file('logo');
            $filename ='images/settings/'.time().'-'.$file->getClientOriginalName();
            File::delete($old_image);
            $file->move('images/settings/', $filename);
        }else{
            $filename = $old_image;
        }
        $setting->logo = $filename;
        $setting->copyrights = $request['copyrights'];
        $setting->currency = $request['currency'];
        $setting->currency_dollar = $request['currency_dollar'];
        $setting->address = $request['address'];
        $setting->whatsapp = $request['whatsapp'];
        $setting->phone = $request['phone'];
        $setting->phone2 = $request['phone2'];
        $setting->email = $request['email'];
        $setting->map = $request['map'];
        $setting->facebook = $request['facebook'];
        $setting->linkedin = $request['linkedin'];
        $setting->twitter = $request['twitter'];
        $setting->snapchat = $request['snapchat'];
        $setting->youtube = $request['youtube'];
        $setting->instagram = $request['instagram'];
        $maintenance = (isset($_POST['maintenance']) == '1' ? '1' : '0');
        $setting->maintenance = $maintenance;

        foreach (app_languages() as $one){
                $setting->translate($one['code'])->title =  $request[$one['code']]['title'];
                $setting->translate($one['code'])->description =  $request[$one['code']]['description'];
            }
        $setting->save();
        return redirect('/admin/settings')->with('success','تم تحديث البيانات بنجاح');
    }
}
