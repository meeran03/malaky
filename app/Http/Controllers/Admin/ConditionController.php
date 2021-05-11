<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConditionRequest;
use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    function __construct()
    {
        $this->middleware('can:conditions read')->only(['index', 'show']);
        $this->middleware('can:conditions create')->only(['create', 'store']);
        $this->middleware('can:conditions update')->only(['edit', 'update']);
        $this->middleware('can:conditions delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = Condition::all();
        return view('admin.conditions.index', ['conditions' => $conditions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.conditions.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConditionRequest $request)
    {
        $condition = new Condition();
        foreach (app_languages() as $one) {
            $condition->translateOrNew($one['code'])->title =  $request[$one['code']]['title'];
        }
        $condition->save();
        return redirect('admin/conditions')->with('success', ' تم إضافة الشرط بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function show(Condition $condition)
    {
        return view('admin.conditions.add', ['condition' => $condition]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function edit(Condition $condition)
    {
        return view('admin.conditions.add', ['condition' => $condition]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function update(ConditionRequest $request, Condition $condition)
    {
        if ($request->has('suspend')) {
            $condition->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/conditions')->with('success', 'تم تفعيل الشرط بنجاح');
            } else {
                return redirect('admin/conditions')->with('error', 'تم إيقاف الشرط بنجاح');
            }
        }

        foreach (app_languages() as $one) {
            $condition->translateOrNew($one['code'])->title =  $request[$one['code']]['title'];
        }
        $condition->save();
        return redirect('admin/conditions')->with('success', ' تم تعديل الشرط بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condition $condition)
    {
        $condition->deleteTranslations();
        $condition->delete();
        return redirect()->back()->with('success', ' تم حذف الشرط بنجاح');
    }
}
