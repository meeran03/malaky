<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    function __construct()
    {
        $this->middleware('can:deliveries read')->only(['index', 'show']);
        $this->middleware('can:deliveries create')->only(['create', 'store']);
        $this->middleware('can:deliveries update')->only(['edit', 'update']);
        $this->middleware('can:deliveries delete')->only(['destroy']);
    }

    public function index()
    {
        $deliveries = Delivery::all();
        return view('admin.deliveries.index', ['deliveries' => $deliveries]);
    }


    public function show(Delivery $delivery)
    {
        return view('admin.deliveries.edit', ['delivery' => $delivery]);
    }

    public function edit(Delivery $delivery)
    {
        return view('admin.deliveries.edit', ['delivery' => $delivery]);
    }

    public function update(Request $request, Delivery $delivery)
    {
        if ($request->has('suspend')) {
            $delivery->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/deliveries')->with('success', 'تم قبول الطلب بنجاح');
            } else {
                return redirect('admin/deliveries')->with('error', 'تم رفض الطلب بنجاح');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return redirect('admin/deliveries')->with('success', ' تم حذف الطلب بنجاح');

    }
}
