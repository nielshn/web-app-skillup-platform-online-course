<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function createPaymentNotification(User $user)
    {
        Notification::create([
            'user_id' => $user->id,
            'message' => 'Pembayaran diproses',
            'status' => 'unread',
        ]);
    }

    public function createApprovalNotification(User $user)
    {
        Notification::create([
            'user_id' => $user->id,
            'message' => 'Pembayaran diterima',
            'status' => 'unread',
        ]);
    }

    public function markAsRead(Request $request)
    {
        Notification::where('user_id', auth()->id())
            ->where('status', 'unread')
            ->update(['status' => 'read']);

        return response()->json(['success' => true]);
    }
}
