<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function __construct()
    {
        $this->middleware('can:coupons read')->only(['index', 'show']);
        $this->middleware('can:coupons create')->only(['create', 'store']);
        $this->middleware('can:coupons update')->only(['edit', 'update']);
        $this->middleware('can:coupons delete')->only(['destroy']);
    }

    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.index', ['coupons' => $coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $coupon = new Coupon();
        
        $coupon->title = $request->title;
        $coupon->units = $request->units;
        $coupon->from = $request->from;
        $coupon->to = $request->to;
        $coupon->save();
        return redirect('admin/coupons')->with('success', ' تم إضافة الكوبون بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.add', ['coupon'  => $coupon]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.add', ['coupon'  => $coupon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        if ($request->has('suspend')) {
            $coupon->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/coupons')->with('success', 'تم تفعيل الكوبون بنجاح');
            } else {
                return redirect('admin/coupons')->with('error', 'تم إيقاف الكوبون بنجاح');
            }
        }
        $coupon->title = $request->title;
        $coupon->units = $request->units;
        $coupon->from = $request->from;
        $coupon->to = $request->to;
        $coupon->save();
        return redirect('admin/coupons')->with('success', ' تم تعديل الكوبون بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('success', ' تم حذف الكوبون بنجاح');
    }
}
