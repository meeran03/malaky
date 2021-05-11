<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Models\Package;
use App\Models\Type;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    function __construct()
    {
        $this->middleware('can:packages read')->only(['index', 'show']);
        $this->middleware('can:packages create')->only(['create', 'store']);
        $this->middleware('can:packages update')->only(['edit', 'update']);
        $this->middleware('can:packages delete')->only(['destroy']);
    }

    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', ['packages' => $packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.packages.add', ['types'  =>  $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $package = new Package();
        foreach (app_languages() as $one) {
            $package->translateOrNew($one['code'])->title =  $request[$one['code']]['title'];
            $package->translateOrNew($one['code'])->feature_1 =  $request[$one['code']]['feature_1'];
            $package->translateOrNew($one['code'])->feature_2 =  $request[$one['code']]['feature_2'];
            $package->translateOrNew($one['code'])->feature_3 =  $request[$one['code']]['feature_3'];
            $package->translateOrNew($one['code'])->feature_4 =  $request[$one['code']]['feature_4'];
        }
        $package->type_id = $request['type_id'];
        $package->units = $request['units'];
        $package->price = $request['price'];
        $package->save();
        return redirect('admin/packages')->with('success', ' تم إضافة الباقة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        $types = Type::all();
        return view('admin.packages.add', ['package' => $package, 'types'  =>  $types]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $types = Type::all();
        return view('admin.packages.add', ['package' => $package, 'types'  =>  $types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, Package $package)
    {
        if ($request->has('suspend')) {
            $package->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/packages')->with('success', 'تم تفعيل الباقة بنجاح');
            } else {
                return redirect('admin/packages')->with('error', 'تم إيقاف الباقة بنجاح');
            }
        }
        foreach (app_languages() as $one) {
            $package->translate($one['code'])->title =  $request[$one['code']]['title'];
            $package->translate($one['code'])->feature_1 =  $request[$one['code']]['feature_1'];
            $package->translate($one['code'])->feature_2 =  $request[$one['code']]['feature_2'];
            $package->translate($one['code'])->feature_3 =  $request[$one['code']]['feature_3'];
            $package->translate($one['code'])->feature_4 =  $request[$one['code']]['feature_4'];
        }
        $package->type_id = $request['type_id'];
        $package->units = $request['units'];
        $package->price = $request['price'];
        $package->save();
        return redirect('admin/packages')->with('success', ' تم تعديل الباقة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->deleteTranslations();
        $package->delete();
        return redirect()->back()->with('success', ' تم حذف الباقة بنجاح');
    }
}
