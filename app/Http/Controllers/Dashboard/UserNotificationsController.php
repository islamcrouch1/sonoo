<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationsController extends Controller
{

    public function index($lang, $user)
    {
        $notifications = Notification::where('user_id', $user)
            ->whenSearch(request()->search)
            ->paginate(50);

        return view('dashboard.notifications.index')->with('notifications', $notifications);
    }

    public function changeStatus(Request $request)
    {

        $notification = Notification::findOrFail($request->notification);
        if ($notification->status == 0) {
            $notification->update([
                'status' => 1,
            ]);
        }
    }


    public function changeStatusAll()
    {
        $notifications = Notification::where('user_id', Auth::user()->id)->get();
        foreach ($notifications as $notification) {
            if ($notification->status == 0) {
                $notification->update([
                    'status' => 1,
                ]);
            }
        }
        return redirect()->back();
    }
}
