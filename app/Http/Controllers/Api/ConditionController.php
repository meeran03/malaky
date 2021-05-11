<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use App\Http\Resources\Condition as ConditionResource;

class ConditionController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 400;

    public function index()
    {
        $tests = Condition::whereIsActive(1)->get();
        return response()->json(api_response( 1 , '' ,  ConditionResource::collection($tests)),$this->successStatus);
    }
}
