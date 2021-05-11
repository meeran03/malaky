<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seek;
use Illuminate\Http\Request;

class SeekController extends Controller
{
    function __construct()
    {
        $this->middleware('can:seeks read')->only(['index', 'show']);
        $this->middleware('can:seeks create')->only(['create', 'store']);
        $this->middleware('can:seeks update')->only(['edit', 'update']);
        $this->middleware('can:seeks delete')->only(['destroy']);
    }

    public function index()
    {
        $seeks = Seek::all();
        return view('admin.seeks.index', ['seeks' => $seeks]);
    }

    public function show(Seek $seek)
    {
        return view('admin.seeks.edit', ['seek' => $seek]);
    }

    public function edit(Seek $seek)
    {
        return view('admin.seeks.edit', ['seek' => $seek]);
    }

    public function update(Request $request, Seek $seek)
    {
        if ($request->has('suspend')) {
            $seek->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/seeks')->with('success', 'تم قبول الطلب بنجاح');
            } else {
                return redirect('admin/seeks')->with('error', 'تم رفض الطلب بنجاح');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seek  $seek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seek $seek)
    {
        $seek->delete();
        return redirect('admin/seeks')->with('success', ' تم حذف الطلب بنجاح');

    }
}
