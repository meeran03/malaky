<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Application;
use App\Models\City;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Package;
use App\Models\SendSms;
use App\Models\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Throwable;


class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::all();
        return view('admin.applications.index', ['applications' =>  $applications]);
    }

    public function show(Application $application)
    {
        return view('admin.applications.edit', ['application' => $application]);
    }

    public function edit(Application $application)
    {
        return view('admin.applications.edit', ['application' => $application]);
    }

    public function update(Request $request, Application $application)
    {

        if ($request->has('suspend') && $request->suspend == 3) {
            $application->update(['is_active' => $request->suspend]);
            return redirect('admin/applications')->with('error', 'تم رفض الطلب الإنضمام كحاضنة بنجاح');
        }
        $userPhone = DB::table('users')->where('phone', '=', $application->phone)->first();
        $userEmail = DB::table('users')->where('email', '=', $application->email)->first();
        if ($userPhone) {
            return redirect('admin/applications')->with('error', 'عفوا لا يمكن قبول هذا العضو كحاضنة , رقم الجوال موجود سابقاَ ');
        } else if ($userEmail) {
            return redirect('admin/applications')->with('error', 'عفوا لا يمكن قبول هذا العضو كحاضنة , البريد الالكتروني موجود سابقاَ ');
        }
        $userRequest = new User();
        $userRequest->phone = $application->phone;
        $userRequest->email = $application->email;
        $userRequest->name = $application->name;
        $password = Str::random(12);
        $userRequest->password = bcrypt($password);
        $userRequest->nationality_id = $application->nationality_id;
        $userRequest->address = $application->address;
        $userRequest->image = $application->image;
        $userRequest->type_id = 2;
        $userRequest->is_active = 1;
        $userRequest->save();
        $application->update(['is_active' => $request->suspend]);

        $phone = '966' . substr($application->phone, 1);
        $msg = api_msg($request, 'رقم الجوال = ' . $application->phone . 'كلمة مرور = ' . $password, 'Phone = ' . $application->phone . ' , Password = ' . $password);
        SendSms::Send($phone, $msg);

        $to_name = $application->name;
        $to_email = $application->email;
        if (isset($to_email)) {
            $data = array('message' =>  $msg ,'email'=> $to_email , 'name' =>$to_name);
            try {
                dispatch(new SendEmailJob($data));
            } catch (Throwable $e) {
//                dd($e);
            }
        }
        return redirect('admin/users')->with('success', 'تم قبول طلب الحاضنة واضافته ضمن الملاذ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        if (File::exists($application->cv)) { unlink($application->cv); }
        if (File::exists($application->infection)) { unlink($application->infection); }
        if (File::exists($application->criminal)) { unlink($application->criminal); }
        $application->delete();
        return redirect('admin/applications')->with('success', ' تم حذف الطلب بنجاح');
    }
}
