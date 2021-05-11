<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Service as ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public $successStatus = 200;
    public function index()
    {
        $services = Service::whereIsActive(1)->get();
        return response()->json(api_response( 1 , '' ,   ServiceResource::collection($services)),$this->successStatus);
    }
}
