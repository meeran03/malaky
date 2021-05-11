<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activation;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    function __construct()
    {
        $this->middleware('can:activations read')->only(['index', 'show']);
        $this->middleware('can:activations create')->only(['create', 'store']);
        $this->middleware('can:activations update')->only(['edit', 'update']);
        $this->middleware('can:activations delete')->only(['destroy']);
    }

    public function index()
    {
        $activations = Activation::all();
        return view('admin.activations.index', ['activations' => $activations]);
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
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function show(Activation $activation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function edit(Activation $activation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activation $activation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activation $activation)
    {
        //
    }
}
