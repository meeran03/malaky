<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Subscription;
use App\Models\Type;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
            $tabs[] = ['title' => 'ملاك', 'icon' => 'mdi mdi-account-multiple', 'count' => User::where('type_id', 1)->where('id', '!=', 1)->count(), 'color' => 'bg-cyan', 'url' => 'admin/users'];
            $tabs[] = ['title' => 'ملاذ', 'icon' => 'fa fa-users', 'count' => User::where('type_id', 2)->where('id', '!=', 1)->count(), 'color' => 'bg-success', 'url' => 'admin/users'];
        }
        if (admin_can_any('subscriptions')) {
            $tabs[] = ['title' => 'الإشتراكات', 'icon' => 'mdi mdi-chart-areaspline', 'count' => Subscription::count(), 'color' => 'bg-warning', 'url' => 'admin/subscriptions'];
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
            $tabs[] = ['title' => 'الطلبات', 'icon' => 'mdi mdi-blinds', 'count' => Order::count(), 'color' => 'bg-orange', 'url' => 'admin/orders'];
            $tabs[] = ['title' => 'الطلبات الشهرية', 'icon' => 'mdi mdi-calendar', 'count' => $orders->count(), 'color' => 'bg-info', 'url' => 'admin/orders'];
            $tabs[] = ['title' => 'الإجمالي الشهري', 'icon' => 'mdi mdi-cash', 'count' => $orders->sum('units'), 'color' => 'bg-dark', 'url' => 'admin/reports'];
        }
        return view('admin.index', ['tabs' => $tabs, 'orders' => $orders]);
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
        return view('admin.users.index', ['types' => $types]);
    }
}
