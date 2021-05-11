<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{

    function __construct()
    {
        $this->middleware('can:sliders read')->only(['index', 'show']);
        $this->middleware('can:sliders create')->only(['create', 'store']);
        $this->middleware('can:sliders update')->only(['edit', 'update']);
        $this->middleware('can:sliders delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', ['sliders' => $sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $slider = new Slider();
        $slider->save();
        foreach (app_languages() as $one) {
            $arr = [];
            if ($request->hasFile($one['code'] . '.image')) :
                foreach ($request[$one['code']]['image'] as $item) :
                    $imageName = 'images/sliders/' . time() . '-' . mb_strtolower($item->getClientOriginalName());
                    $item->move('images/sliders/', $imageName);
                    $arr[] = $imageName;
                endforeach;
                $image = implode(";", $arr);
            else :
                $image = null;
            endif;
            $slider->transes()->updateOrCreate([
                'locale' => $one['code'],
                'title' => $request[$one['code']]['title'],
                'slug' => mb_strtolower(str_replace(' ', '-', $request[$one['code']]['title'])),
                'excerpt' => $request[$one['code']]['excerpt'],
                'content' => $request[$one['code']]['content'],
                'image' => $image,
            ]);
        }
        return redirect('admin/sliders')->with('success', ' تم إضافة السلايدر بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('admin.sliders.add', ['slider' => $slider]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.add', ['slider' => $slider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        if ($request->has('suspend')) {
            $slider->update(['is_active' => $request->suspend]);
            if ($request->suspend == 1) {
                return redirect('admin/sliders')->with('success', 'تم تفعيل السلايدر بنجاح');
            } else {
                return redirect('admin/sliders')->with('error', 'تم إيقاف السلايدر بنجاح');
            }
        }

        foreach (app_languages() as $one) {
            $arr = [];
            $old_images = $slider->trans($one['code'])->image;
            if ($request->hasFile($one['code'] . '.image')) :
                foreach (explode(';', $old_images) as $item) :
                    File::delete($item);
                endforeach;

                foreach ($request[$one['code']]['image'] as $item) :
                    $imageName = 'images/sliders/' . time() . '-' . mb_strtolower($item->getClientOriginalName());
                    $item->move('images/sliders/', $imageName);
                    $arr[] = $imageName;
                endforeach;
                $image = implode(";", $arr);
            else :
                $image = $old_images;
            endif;
            $slider->trans($one['code'])->update([
                'title' => $request[$one['code']]['title'],
                'slug' => mb_strtolower(str_replace(' ', '-', $request[$one['code']]['title'])),
                'excerpt' => $request[$one['code']]['excerpt'],
                'content' => $request[$one['code']]['content'],
                'image' => $image,
            ]);
        }
        return redirect('admin/sliders')->with('success', ' تم تعديل السلايدر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        foreach (app_languages() as $one) {
            $old_images = $slider->trans($one['code'])->image;
            foreach (explode(';', $old_images) as $item) :
                File::delete($item);
            endforeach;
        }
        $slider->transes()->delete();
        $slider->delete();
        return redirect()->back()->with('success', ' تم حذف السلايدر بنجاح');
    }
}
