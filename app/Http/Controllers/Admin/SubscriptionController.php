<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Subscription;
use App\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    function __construct() {
        $this->middleware('can:subscriptions read')->only(['index', 'show']);
        $this->middleware('can:subscriptions create')->only(['create','store']);
        $this->middleware('can:subscriptions update')->only(['edit','update']);
        $this->middleware('can:subscriptions delete')->only(['destroy']);
    }

    public function index()
    {
        $subscriptions = Subscription::all();
        $settings = Setting::first();
        $users = User::first();
        return view('admin.subscriptions.index',['subscriptions' => $subscriptions ,'settings' => $settings ,'users' => $users]);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->back()->with('success', 'تم حذف الاشتراك بنجاح');
    }
}
