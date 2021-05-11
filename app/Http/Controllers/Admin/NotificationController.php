<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function __construct()
    {
        $this->middleware('can:notifications read')->only(['index', 'show']);
        $this->middleware('can:notifications create')->only(['create', 'store']);
        $this->middleware('can:notifications update')->only(['edit', 'update']);
        $this->middleware('can:notifications delete')->only(['destroy', 'destroyAll']);
    }

    public function index()
    {
        $unreadNotifications = Auth::user()->unreadNotifications;
        $latestFiveUnreadNotifications = Auth::user()->unreadNotifications()->latest()->take(5)->get();
        $latestTenUnreadNotifications = Auth::user()->unreadNotifications()->latest()->take(10)->get();
        $readNotifications = Auth::user()->readNotifications;
        $allNotifications = Auth::user()->notifications;
        return view(
            'admin.notifications.index',
            [
                'unreadNotifications'           => $unreadNotifications,
                'latestFiveUnreadNotifications' => $latestFiveUnreadNotifications,
                'latestTenUnreadNotifications'  => $latestTenUnreadNotifications,
                'allNotifications'              => $allNotifications,
                'readNotifications'             => $readNotifications
            ]
        );
    }

    public function show($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();
        if (isset($notification)) {
            $notification->markAsRead();
            return redirect('admin/' . $notification->data['url']);
        } else {
            return redirect('admin/notifications');
        }
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'تم قراءة كل الإشعارات بنجاح');
    }

    public function update(Request $request, $id)
    {
        if ($request->has('suspend')) {
            $notification = Auth::user()->notifications()->where('id', $id)->first();
            $notification->update(['read_at' => $request->suspend]);
            if ($request->suspend == true) {
                return redirect()->back()->with('success', 'تم قراءة الإشعار بنجاح');
            }
        }
    }

    public function destroy($id)
    {
        Auth::user()->notifications()->where('id', $id)->first()->delete();
        return redirect()->back()->with('success', 'تم حذف الإشعار بنجاح');
    }

    public function destroyAll()
    {
        if (Auth::user()->notifications()->count()) {
            Auth::user()->notifications()->delete();
            return redirect()->back()->with('success', 'تم حذف كل الإشعارات بنجاح');
        } else {
            return redirect()->back();
        }
    }
}
