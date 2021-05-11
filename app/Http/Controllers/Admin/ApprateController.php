<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apprate;
use Illuminate\Http\Request;

class ApprateController extends Controller
{
    function __construct()
    {
        $this->middleware('can:apprates read')->only(['index', 'show']);
        $this->middleware('can:apprates create')->only(['create', 'store']);
        $this->middleware('can:apprates update')->only(['edit', 'update']);
        $this->middleware('can:apprates delete')->only(['destroy']);
    }

    public function index()
    {
        $values = array();
        $apprates = Apprate::all();
        for ($i = 0; $i < count($apprates); $i++) {
            array_push($values, $apprates[$i]->value);
        }

        if (count($values) == 0) {
            $rateAverage = 0;
        } else {
            $rateAverage = array_sum($values) / count($values);
        }

        return view('admin.apprates.index', ['apprates' => $apprates, 'rateAverage' => $rateAverage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apprate  $apprate
     * @return \Illuminate\Http\Response
     */
    public function show(Apprate $apprate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apprate  $apprate
     * @return \Illuminate\Http\Response
     */
    public function edit(Apprate $apprate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apprate  $apprate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apprate $apprate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apprate  $apprate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apprate $apprate)
    {
        //
    }
}
