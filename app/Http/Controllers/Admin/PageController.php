<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    function __construct()
    {
        $this->middleware('can:pages read')->only(['index', 'show']);
        $this->middleware('can:pages create')->only(['create', 'store']);
        $this->middleware('can:pages update')->only(['edit', 'update']);
        $this->middleware('can:pages delete')->only(['destroy']);
    }

    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page = new Page();
        if (isset($request->image)) {
            $file = $request->image;
            $filename = 'images/pages/' . time() . '-' . $file->getClientOriginalName();
            $file->move('images/pages/', $filename);
        } else {
            $filename = $page->image;
        }
        $page->image = $filename;
        foreach (app_languages() as $one) {
            $page->translateOrNew($one['code'])->title =  $request[$one['code']]['title'];
            $page->translateOrNew($one['code'])->slug = strtolower(str_replace(' ', '-', $request[$one['code']]['title']));
            $page->translateOrNew($one['code'])->excerpt =  $request[$one['code']]['excerpt'];
            $page->translateOrNew($one['code'])->content =  $request[$one['code']]['content'];
        }
        $page->save();
        return redirect('admin/pages')->with('success', ' تم إضافة الصفحة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('admin.pages.add', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.add', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        if ($request->has('suspend')) {
            $page->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/pages')->with('success', 'تم تفعيل الصفحة بنجاح');
            } else {
                return redirect('admin/pages')->with('error', 'تم إيقاف الصفحة بنجاح');
            }
        }

        $old_image = $page->image;
        if (isset($request->image)) {
            $file = $request->image;
            $filename = 'images/pages/' . time() . '-' . $file->getClientOriginalName();
            File::delete($old_image);
            $file->move('images/pages/', $filename);
        } else {
            $filename = $old_image;
        }
        $page->image = $filename;

        foreach (app_languages() as $one) {
            $page->translate($one['code'])->title =  $request[$one['code']]['title'];
            $page->translate($one['code'])->slug =  strtolower(str_replace(' ', '-', $request[$one['code']]['title']));
            $page->translate($one['code'])->excerpt =  $request[$one['code']]['excerpt'];
            $page->translate($one['code'])->content =  $request[$one['code']]['content'];
        }
        $page->save();
        return redirect('admin/pages')->with('success', ' تم تعديل الصفحة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if (is_file(public_path($page->image))) {
            File::delete($page->image);
        }
        $page->deleteTranslations();
        $page->delete();
        return redirect()->back()->with('success', ' تم حذف الصفحة بنجاح');
    }
}
