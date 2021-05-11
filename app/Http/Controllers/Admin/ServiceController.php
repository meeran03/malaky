<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    function __construct()
    {
        $this->middleware('can:services read')->only(['index', 'show']);
        $this->middleware('can:services create')->only(['create', 'store']);
        $this->middleware('can:services update')->only(['edit', 'update']);
        $this->middleware('can:services delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service();
        foreach (app_languages() as $one) {
            $service->translateOrNew($one['code'])->title =  $request[$one['code']]['title'];
        }
        $service->save();
        return redirect('admin/services')->with('success', ' تم إضافة الخدمة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('admin.services.add', ['service' => $service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.services.add', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        if ($request->has('suspend')) {
            $service->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/services')->with('success', 'تم تفعيل الخدمة بنجاح');
            } else {
                return redirect('admin/services')->with('error', 'تم إيقاف الخدمة بنجاح');
            }
        }

        foreach (app_languages() as $one) {
            $service->translateOrNew($one['code'])->title =  $request[$one['code']]['title'];
        }
        $service->save();
        return redirect('admin/services')->with('success', ' تم تعديل الخدمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->deleteTranslations();
        $service->delete();
        return redirect()->back()->with('success', ' تم حذف الخدمة بنجاح');
    }
}
