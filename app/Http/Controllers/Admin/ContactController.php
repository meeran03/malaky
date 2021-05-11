<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    function __construct()
    {
        $this->middleware('can:contacts read')->only(['index', 'show']);
        $this->middleware('can:contacts create')->only(['create', 'store']);
        $this->middleware('can:contacts update')->only(['edit', 'update']);
        $this->middleware('can:contacts delete')->only(['destroy']);
    }

    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', ['contacts' => $contacts]);
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.edit', ['contact' => $contact]);
    }

    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', ['contact' => $contact]);
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->reply = $request->reply;
        $contact->save();
        return redirect('admin/contacts')->with('success', ' تم الرد على جهة الاتصال بنجاح');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect('admin/contacts')->with('success', ' تم حذف جهة الاتصال بنجاح');
    }
}
