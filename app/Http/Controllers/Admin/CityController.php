<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Requests\CityUpdateRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    function __construct() {
        $this->middleware('can:cities read')->only(['index', 'show']);
        $this->middleware('can:cities create')->only(['create','store']);
        $this->middleware('can:cities update')->only(['edit','update']);
        $this->middleware('can:cities delete')->only(['destroy']);
    }
    public function index()
    {
        $cities = City::with('country')->get();
        return view('admin.cities.index', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.cities.add', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $data = $request->except('_token');
        $city = City::updateOrCreate($data);
        return redirect('admin/cities')->with('success', ' تم إضافة المدينة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $countries = Country::all();
        return view('admin.cities.add', ['city' => $city, 'countries' => $countries]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::all();
        return view('admin.cities.add', ['city' => $city, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityUpdateRequest $request, City $city)
    {
        $data = $request->except(['_token', '_method']);
        $city->update($data);
        return redirect('admin/cities')->with('success', ' تم تعديل المدينة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if (count($city->users) == 0) {
            $city->delete();
            return redirect('admin/cities')->with('success', ' تم حذف المدينة بنجاح');
        } else {
            return redirect()->back()->with('error', ' لايمكن حذف هذه المدينة بسبب ارتباطها بمستخدم ');
        }
    }
}
