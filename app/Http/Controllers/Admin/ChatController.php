<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    function __construct() {
        $this->middleware('can:chats read')->only(['index', 'show']);
        $this->middleware('can:chats create')->only(['create','store']);
        $this->middleware('can:chats update')->only(['edit','update']);
        $this->middleware('can:chats delete')->only(['destroy']);
    }
    public function index()
    {
        $chats = Chat::orderBy('created_at' ,'desc')->get();
        return view('admin.chats.index', ['chats' => $chats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chats = Chat::orderBy('created_at' ,'desc')->get();
        return view('admin.chats.index', ['chats' => $chats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $chat = Chat::updateOrCreate($data);
        return redirect('admin/chats')->with('success', ' تم إضافة المحادثة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        return view('admin.chats.add', ['chat' => $chat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        return view('admin.chats.add', ['chat' => $chat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        $data = $request->except(['_token', '_method']);
        $chat->update($data);
        return redirect('admin/chats')->with('success', ' تم تعديل المحادثة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        $chat->messages->delete();
        $chat->delete();
        return redirect('admin/chats')->with('success', ' تم حذف المحادثة بنجاح');
    }
}
