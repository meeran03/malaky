<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Nationality as NationalityResource;
use App\Http\Controllers\Controller;
use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public $successStatus = 200;
    public function index()
    {
        $countries = Nationality::get();
        return response()->json( NationalityResource::collection($countries),$this->successStatus);
    }
}
