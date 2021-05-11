<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaticpageRequest;
use Illuminate\Http\Request;
use App\Models\Staticpage;
use Illuminate\Support\Facades\File;

class StaticpageController extends Controller
{
    public function __construct()
    {
        return $app_langs = [
            [ "id" => 1,"title" => "عربي","code" => "ar" ] ,
            [ "id" => 2,"title" => "English","code" => "en" ]
        ];
    }

    public function index()
    {
        $app_langs = $this->__construct();
        $staticpages = Staticpage::all();
        return view('admin.staticpages.index', ['staticpages' => $staticpages , 'app_langs' =>$app_langs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $app_langs = $this->__construct();
        return view('admin.staticpages.add', ['app_langs' =>$app_langs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaticpageRequest $request)
    {
        $app_langs = $this->__construct();
        $staticpage = new Staticpage();
        $staticpage->save();
        foreach ($app_langs as $one) {
            $arr=[];
            if ($request->hasFile($one['code'].'.images')) :
                foreach ($request[$one['code']]['images'] as $item):
                    $imageName = 'images/staticpages/' . time() . '-' . mb_strtolower($item->getClientOriginalName());
                    $item->move( 'images/staticpages/', $imageName);
                    $arr[] = $imageName;
                endforeach;
                $images = implode(";", $arr);
            else:
                $images = null;
            endif;
            $staticpage->transes()->updateOrCreate([
                'locale' => $one['code'],
                'title' => $request[$one['code']]['title'],
                'slug' => mb_strtolower(str_replace(' ', '-', $request[$one['code']]['title'])),
                'excerpt' => $request[$one['code']]['excerpt'],
                'content' => $request[$one['code']]['content'],
                'images' => $images,
            ]);
        }
        return redirect('admin/staticpages')->with('success', ' تم إضافة الجزئية بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Staticpage $staticpage)
    {
        $app_langs = $this->__construct();
        return view('admin.staticpages.add', ['staticpage' => $staticpage, 'app_langs' =>$app_langs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(StaticpageRequest $request, Staticpage $staticpage)
    {
        if ($request->has('suspend')) {
            $staticpage->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/staticpages')->with('success', 'تم تفعيل الجزئية بنجاح');
            } else {
                return redirect('admin/staticpages')->with('error', 'تم إيقاف الجزئية بنجاح');
            }
        }
        $app_langs = $this->__construct();
        foreach ($app_langs as $one) {
            $arr=[];
            $old_images = $staticpage->trans($one['code'])->images;
            if ($request->hasFile($one['code'].'.images')) :
                foreach (explode(';',$old_images) as $item):
                    File::delete($item);
                endforeach;

                foreach ($request[$one['code']]['images'] as $item):
                    $imageName = 'images/staticpages/' . time() . '-' . mb_strtolower($item->getClientOriginalName());
                    $item->move( 'images/staticpages/', $imageName);
                    $arr[] = $imageName;
                endforeach;
                $images = implode(";", $arr);
            else:
                $images = $old_images;
            endif;
            $staticpage->trans($one['code'])->update([
                'title' => $request[$one['code']]['title'],
                'slug' => mb_strtolower(str_replace(' ', '-', $request[$one['code']]['title'])),
                'excerpt' => $request[$one['code']]['excerpt'],
                'content' => $request[$one['code']]['content'],
                'images' => $images,
            ]);
        }
        return redirect()->back()->with('success', ' تم تعديل الجزئية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staticpage $staticpage)
    {
        $app_langs = $this->__construct();
        foreach ($app_langs as $one) {
            $old_images = $staticpage->trans($one['code'])->images;
            foreach (explode(';', $old_images) as $item):
                File::delete($item);
            endforeach;
        }
        $staticpage->transes()->delete();
        $staticpage->delete();
        return redirect()->back()->with('success', ' تم حذف الجزئية بنجاح');
    }
}
