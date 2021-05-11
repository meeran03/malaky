<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::whereTranslation('slug', $slug)->firstOrFail();
        $lang = session()->get('locale') ?? 'ar';
        return view('website.pages.index', ['page' => $page , 'lang' => $lang]);
    }

}
