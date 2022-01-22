<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }
    public function Notify()
    {
        return [
            'read' => NotificationResource::collection(auth()->user()->readNotifications),
            'unread' => NotificationResource::collection(auth()->user()->unreadNotifications),
        ];
    }
    public function Read(Request $request)
    {
        auth()->user()->notifications->where('id',$request->id)->markAsRead();
    }
}
