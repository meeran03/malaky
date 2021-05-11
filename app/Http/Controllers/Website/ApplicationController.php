<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationRequest;
use App\Jobs\SendEmailJob;
use App\Models\Application;
use App\Models\Nationality;
use App\Notifications\AccountNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Notification;
use Throwable;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang = 'ar')
    {
        $lang = session()->get('locale') ?? 'ar';
        $nationalities = Nationality::all();
        return view('website.applications.index', [ 'nationalities' => $nationalities, 'lang' => $lang]);
    }

    public function store(ApplicationRequest $request)
    {
        $application = new Application();
        $application->name = $request['name'];
        $application->identity = $request['identity'];
        $application->email = $request['email'];
        $application->nationality_id = $request['nationality_id'];
        $application->phone = $request['phone'];
        $application->iban = $request['iban'];
        $application->address = $request['address'];
        $application->married = $request['married'];
        $application->has_childrens = $request['has_childrens'];
        $application->childrens = $request['childrens'] ?? 0;

        if ($request->hasfile('cv')) {
            $cvFile = $request->file('cv');
            $cvFileName = 'sitter/cv/' . time() . '-' . $cvFile->getClientOriginalName();
            $cvFile->move('sitter/cv/', $cvFileName);
            $application->cv = $cvFileName;
        }

        if ($request->hasfile('infection')) {
            $infectionFile = $request->file('infection');
            $infectionFileName = 'sitter/infection/' . time() . '-' . $infectionFile->getClientOriginalName();
            $infectionFile->move('sitter/infection/', $infectionFileName);
            $application->infection = $infectionFileName;
        }

        if ($request->hasfile('criminal')) {
            $criminalFile = $request->file('criminal');
            $criminalFileName = 'sitter/criminal/' . time() . '-' . $criminalFile->getClientOriginalName();
            $criminalFile->move('sitter/criminal/', $criminalFileName);
            $application->criminal = $criminalFileName;
        }
        $application->save();
        if( session()->get('locale') == 'en'){
            $msg = 'Your Application has been successfully sent and it will be reviewed by the administration in the shortest time';
        }else{
            $msg = "تم إرسال طلبك بنجاح و سوف يتم مراجعتها من الإدارة في أقرب وقت";
        }
        $notify_ar = "تم إستلام طلب إنضمام حاضنة";
        $notify_en = 'Application to join an babysitter received';
        Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'applications' , $application->id ));

        if (isset(app_settings()->email)) {
            $message = ' تم إستلام طلب إنضمام حاضنة '.$application->name . ' - جوال  : '.$application->phone;
            $data = array('message' =>  $message ,'email'=> app_settings()->email , 'name' =>'طلب حاضنة جديد من '.$application->name);
            try {
                dispatch(new SendEmailJob($data));
            } catch (Throwable $e) {
//                dd($e);
            }
        }
        return redirect('applications_sent')->with('success',$msg);
    }

    public function sent()
    {
        $lang = session()->get('locale') ?? 'ar';
        return view('website.applications.sent' , [ 'lang' => $lang]);
    }

}
