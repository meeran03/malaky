<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Children;
use App\Models\Contact;
use App\Models\Type;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application adminpanel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::latest()->take(10)->get();
        $tabs = [];
        if (admin_can_any('users')) {
            $angels = User::where('type_id', 1)->where('id', '!=', 1)->orderBy('id', 'DESC')->get();
            $incubators = User::where('type_id', 2)->where('id', '!=', 1)->orderBy('id', 'DESC')->get();
            $active_incubators = User::where('type_id', 2)->where('id', '!=', 1)->where('is_active', '!=', 0)->orderBy('id', 'DESC')->get();
            $blocked_incubators = User::where('type_id', 2)->where('id', '!=', 1)->where('is_active', '!=', 1)->orderBy('id', 'DESC')->get();
            $children = Children::orderBy('id', 'DESC')->get();
            $contacts = Contact::where('type','!=','contact')->get();
            $tabs[] = ['title' => 'ملاك', 'icon' => 'mdi mdi-account-multiple', 'count' => User::where('type_id', 1)->where('id', '!=', 1)->count(), 'color' => 'bg-cyan', 'type' => "angels"];
            $tabs[] = ['title' => 'ملاذ', 'icon' => 'fa fa-users', 'count' => User::where('type_id', 2)->where('id', '!=', 1)->count(), 'color' => 'bg-success', 'type' => "incubators"];
            $tabs[] = ['title' => ' الحاضنات المفعلين', 'icon' => 'fa fa-check', 'count' => User::where('type_id', 2)->where('id', '!=', 1)->where('is_active', '!=', 0)->count(), 'color' => 'bg-info', 'type' => "active_incubators"];
            $tabs[] = ['title' => ' الحاضنات الغير المفعلين', 'icon' => 'fa fa-times', 'count' => User::where('type_id', 2)->where('id', '!=', 1)->where('is_active', '!=', 1)->count(), 'color' => 'bg-orange', 'type' => "blocked_incubators"];
            $tabs[] = ['title' => ' عدد االطفال', 'icon' => 'fa fa-users', 'count' => Children::count(), 'color' => 'bg-primary', 'type' => "children"];
            $tabs[] = ['title' => '  عدد الشكاوي', 'icon' => 'fa fa-users', 'count' => Contact::where('type','!=','contact')->count(), 'color' => 'bg-danger', 'type' => "contacts"];
            
        }
        if (admin_can_any('orders')) {
            $now = Carbon::now();
            $start_date = $now->firstOfMonth();
            $end_date = Carbon::now();
            $orders = Order::where([
                ['from','>=',$start_date],
                ['from','<=',$end_date],
                ['status_id','>=',3],
                ['status_id','<=',6],
            ])->orderBy('id', 'DESC')->get();
            // $tabs[] = ['title' => 'الطلبات', 'icon' => 'mdi mdi-blinds', 'count' => Order::count(), 'color' => 'bg-orange', 'url' => 'admin/orders'];
            // $tabs[] = ['title' => 'الطلبات الشهرية', 'icon' => 'mdi mdi-calendar', 'count' => $orders->count(), 'color' => 'bg-info', 'url' => 'admin/orders'];
            // $tabs[] = ['title' => 'الإجمالي الشهري', 'icon' => 'mdi mdi-cash', 'count' => $orders->sum('units'), 'color' => 'bg-dark', 'url' => 'admin/reports'];
        }
        $incubators = User::where('type_id', 2)->where('id', '!=', 1)->orderBy('id', 'DESC')->get();
        $angels = User::where('type_id', 1)->where('id', '!=', 1)->orderBy('id', 'DESC')->get();
        $active_incubators = User::where('type_id', 2)->where('id', '!=', 1)->where('is_active', '!=', 0)->orderBy('id', 'DESC')->get();
        $blocked_incubators = User::where('type_id', 2)->where('id', '!=', 1)->where('is_active', '!=', 1)->orderBy('id', 'DESC')->get();
        $children = Children::orderBy('id', 'DESC')->get();
        $contacts = Contact::where('type','!=','contact')->get();
        return view('admin.statistics.index', 
        [
            'tabs' => $tabs, 
            'angels' => $angels,
            'active_incubators' => $active_incubators,
            'incubators' => $incubators,
            'blocked_incubators' => $blocked_incubators,
            'children' => $children,
            'contacts' => $contacts,
        ]);
    }

    public function search(Request $request)
    {
        $types = Type::with(['users' => function ($q) use ($request) {
            $q->where([
                ['id', '!=', 1],
                ['name', 'Like', '%' . $request->search . '%'],
            ])->orWhere([
                ['id', '!=', 1],
                ['email', 'Like', '%' . $request->search . '%']
            ]);
        }])->get();
        return view('admin.statistics.index', ['types' => $types]);
    }
}
