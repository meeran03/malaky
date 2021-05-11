<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    function __construct() {
        $this->middleware('can:messages read')->only(['index', 'show']);
        $this->middleware('can:messages create')->only(['create','store']);
        $this->middleware('can:messages update')->only(['edit','update']);
        $this->middleware('can:messages delete')->only(['destroy']);
    }
}
