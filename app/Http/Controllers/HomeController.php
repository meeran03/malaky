<?php

namespace App\Http\Controllers;

use App\Models\Staticpage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application adminpanel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lang = session()->get('locale') ?? 'ar';
        $staticpages = Staticpage::with('transes')->get()->toArray();
        if(!empty(app_settings()) && app_settings()->maintenance == 1 ){
            return view('errors.maintenance');
        }
        return view('staticpage.index',['lang'=>$lang , 'staticpages'=>$staticpages]);
    }

    public function lang($locale)
    {
        $app_langs = app_languages();
        if ( ! in_array($locale ,array_column($app_langs , 'code') )){
            $locale = 'ar';
        }
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
