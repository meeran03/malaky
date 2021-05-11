<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    function __construct()
    {
        $this->middleware('can:statuses read')->only(['index', 'show']);
        $this->middleware('can:statuses create')->only(['create', 'store']);
        $this->middleware('can:statuses update')->only(['edit', 'update']);
        $this->middleware('can:statuses delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        return view('admin.statuses.index', ['statuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.statuses.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusRequest $request)
    {
        $status = new Status();
        foreach (app_languages() as $one) {
            $status->translateOrNew($one['code'])->title =  $request[$one['code']]['title'];
        }
        $status->save();
        return redirect('admin/statuses')->with('success', ' تم إضافة حالة الطلب بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        return view('admin.statuses.add', ['status' => $status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return view('admin.statuses.add', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $request, Status $status)
    {
        if ($request->has('suspend')) {
            $status->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/statuses')->with('success', 'تم تفعيل حالة الطلب بنجاح');
            } else {
                return redirect('admin/statuses')->with('error', 'تم إيقاف حالة الطلب بنجاح');
            }
        }

        foreach (app_languages() as $one) {
            $status->translateOrNew($one['code'])->title =  $request[$one['code']]['title'];
        }
        $status->save();
        return redirect('admin/statuses')->with('success', ' تم تعديل حالة الطلب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->deleteTranslations();
        $status->delete();
        return redirect()->back()->with('success', ' تم حذف حالة الطلب بنجاح');
    }
}
