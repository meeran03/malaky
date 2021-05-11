<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Withdrawal;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    function __construct()
    {
        $this->middleware('can:withdrawals read')->only(['index', 'show']);
        $this->middleware('can:withdrawals create')->only(['create', 'store']);
        $this->middleware('can:withdrawals update')->only(['edit', 'update']);
        $this->middleware('can:withdrawals delete')->only(['destroy']);
    }

    public function index()
    {
        $users = User::where(['type_id'=>2 , 'is_active'=>1])->get();
        return view('admin.withdrawals.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $start_date = Carbon::parse($request->start_date);
        $end_date =  Carbon::parse($request->end_date);
        $orders = Order::where([
            ['from','>=',$start_date],
            ['from','<=',$end_date],
            ['status_id','>=',3],
            ['status_id','<=',6],
            ['receiver_id','=',$request->receiver_id]
        ])->get();
        $total = $orders->sum('units');
        return view('admin.reports.index', ['orders' => $orders ,
            'start_date' => $start_date, 'end_date' => $end_date , 'total' =>$total]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.withdrawals.edit', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $withdrawals = $user->withdrawals->first();
        $start_date = !empty($withdrawals)? $withdrawals->end_date : $user->created_at->format('Y-m-d')  ;
        $end_date = Carbon::today();
        $orders = Order::where([
            ['from','>=',$start_date],
            ['from','<=',$end_date],
            ['status_id','>=',3],
            ['status_id','<=',6],
            ['receiver_id','=',$user->id]
        ])->get();
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = $user->id;
        $withdrawal->amount = $orders->sum('units') ;
        $withdrawal->start_date = $start_date;
        $withdrawal->end_date = $end_date;
        $withdrawal->save();
        return redirect('admin/withdrawals')->with('success' , 'تم عمل تسوية جديدة للعضو بنجاح');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->withdrawals()->where('is_active',0)->update(['is_active'=>1]);
        return redirect()->back()->with('success' , 'تم تصفيةالحساب للعضو بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
    }
}
