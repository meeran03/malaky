<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\City as CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public $successStatus = 200;
    public function index($id)
    {
        $cities = City::where('country_id',$id)->get();
        return response()->json( CityResource::collection($cities),$this->successStatus);
    }
}
