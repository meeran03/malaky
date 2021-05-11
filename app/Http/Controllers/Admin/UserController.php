<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Package;
use App\Models\Type;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('can:users read')->only(['index', 'show']);
        $this->middleware('can:users create')->only(['create', 'store']);
        $this->middleware('can:users update')->only(['edit', 'update']);
        $this->middleware('can:users delete')->only(['destroy']);
    }

    public function storeImg($request, $path)
    {
        if ($request->hasFile('image')) {
            $oldpath = $request->old_image;
            if ($oldpath) {
                if (File::exists($oldpath)) {
                    unlink($oldpath);
                }
            }
            $file = $request->file('image');
            $filepath = 'images/' . $path . '/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . strtolower(preg_replace('/\s+/', '-', $file->getClientOriginalName()));
            $file->move($filepath, $filename);
        } else {
            $filename =  $request->old_image ?? null;
        }
        return $filename;
    }
    public function index()
    {
        $types = Type::with(['users' => function ($q) {
            $q->where('id', '!=', 1);
        }])->get();
        return view('admin.users.index', ['types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $cities = City::all();
        $nationalities = Nationality::all();
        $packages = Package::all();
        $types = Type::all();
        $roles = Role::all();
        return view('admin.users.add', [
            'countries' => $countries, 'cities' => $cities, 'nationalities' => $nationalities,
            'packages' => $packages, 'types' => $types, 'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->except('_token', 'image', 'password', 'role_name');
        $data['image'] = $this->storeImg($request, 'users');
        $data['password'] = bcrypt($request->password);
        $data['units'] = $request->units ?? 0;
        $user = User::updateOrCreate($data);
        if (isset($request->role_name)) {
            $user->assignRole($request->role_name);
        }
        return redirect('admin/users')->with('success', ' تم إضافة العضو بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if($user->id == 1 && Auth::id() !== 1){
            return redirect('/admin/users')->with('error','هذا الرابط غير صحيح');
        };
        $countries = Country::all();
        $cities = City::all();
        $nationalities = Nationality::all();
        $packages = Package::all();
        $types = Type::all();
        $roles = Role::all();
        return view('admin.users.add', [
            'user' => $user, 'countries' => $countries, 'cities' => $cities, 'nationalities' => $nationalities,
            'packages' => $packages, 'types'  =>  $types, 'roles' => $roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user->id == 1 && Auth::id() !== 1){
            return redirect('/admin/users')->with('error','هذا الرابط غير صحيح');
        };
        $countries = Country::all();
        $cities = City::all();
        $nationalities = Nationality::all();
        $packages = Package::all();
        $types = Type::all();
        $roles = Role::all();
        return view('admin.users.add', [
            'user' => $user, 'countries' => $countries, 'cities' => $cities, 'nationalities' => $nationalities,
            'packages' => $packages, 'types'  =>  $types , 'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        if ($request->has('suspend')) {
            $user->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/users')->with('success', 'تم تفعيل العضو بنجاح');
            } else {
                return redirect('admin/users')->with('error', 'تم إيقاف العضو بنجاح');
            }
        }
        $data = $request->except('_token', 'image', 'password', 'old_image', 'role_name');
        $data['image'] = $this->storeImg($request, 'users');
        if (trim($request->password) != '') {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        $user->syncRoles($request->role_name);
        return redirect('admin/users')->with('success', ' تم تعديل العضو بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == 1) {
            return redirect()->back()->with('error', 'لايمكن حذف هذا العضو');
        }
        $oldpath = $user->image;
        if ($oldpath) {
            if (File::exists($oldpath)) {
                unlink($oldpath);
            }
        }
        $user->delete();
        return redirect()->back()->with('success', 'تم حذف العضو ' . $user->name . ' بنجاح .');
    }
}
