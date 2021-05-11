<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Country as CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public $successStatus = 200;
    public function index()
    {
        $countries = Country::whereHas('cities')->get();
        return response()->json( CountryResource::collection($countries),$this->successStatus);
    }
}
