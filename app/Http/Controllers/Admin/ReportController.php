<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Models\Address;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function __construct()
    {
        $this->middleware('can:orders read')->only(['index', 'show']);
        $this->middleware('can:orders create')->only(['create', 'store']);
        $this->middleware('can:orders update')->only(['edit', 'update']);
        $this->middleware('can:orders delete')->only(['destroy']);
    }

    public function index(ReportRequest $request)
    {
        $now = Carbon::now();
        $start_date = ($request->start_date) ? Carbon::parse($request->start_date) : $now->firstOfMonth();
        $end_date = ($request->end_date) ?  Carbon::parse($request->end_date) : Carbon::now();
        $orders = Order::where([
            ['from','>=',$start_date],
            ['from','<=',$end_date],
            ['status_id','>=',3],
            ['status_id','<=',6],
            ])->get();
        $total = $orders->sum('units');
        return view('admin.reports.index', ['orders' => $orders ,
            'start_date' => $start_date, 'end_date' => $end_date , 'total' =>$total]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
