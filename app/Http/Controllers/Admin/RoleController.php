<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Apptable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct() {
        $this->middleware('can:roles read')->only(['index', 'show']);
        $this->middleware('can:roles create')->only(['create','store']);
        $this->middleware('can:roles update')->only(['edit','update']);
        $this->middleware('can:roles delete')->only(['destroy']);
    }
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index' , [ 'roles' => $roles ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $app_tables =Apptable::whereIsActive(1)->get();
        return view('admin.roles.add', ['app_tables' =>$app_tables]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::updateOrCreate(['name'=>$request->name]);
        if(isset($request->permissions)){
            foreach ($request->permissions as $one){
                $role -> givePermissionTo($one);
            }
        }
        return redirect('admin/roles')->with('success', ' تم إضافة الدور بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $app_tables =Apptable::whereIsActive(1)->get();
        return view('admin.roles.add', ['role' => $role , 'app_tables' =>$app_tables]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $app_tables =Apptable::whereIsActive(1)->get();
        return view('admin.roles.add', ['role' => $role , 'app_tables' =>$app_tables]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->update(['name'=>$request->name]);
        $roleOldPer = array_column($role->permissions()->get()->toArray() , 'name') ?? [];
        $roleNewPer = $request->permissions ?? [];
        $roleAllRevoked = array_diff($roleOldPer,$roleNewPer);
        $roleAllNew = array_diff($roleNewPer,$roleOldPer);
        foreach ($roleAllRevoked as $one){
            $role -> revokePermissionTo($one);
        }
        foreach ($roleAllNew as $one){
            $role -> givePermissionTo($one);
        }
        return redirect('admin/roles')->with('success', ' تم تعديل الدور بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (count($role->users) == 0) {
            $role->delete();
            return redirect('admin/roles')->with('success', ' تم حذف الدور بنجاح');
        } else {
            return redirect()->back()->with('error', ' لايمكن حذف هذه الدور بسبب ارتباطها بمستخدم ');
        }
    }
}
