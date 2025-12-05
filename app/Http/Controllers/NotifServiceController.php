<?php

namespace App\Http\Controllers;

use App\Helpers\FcmHelper;
use App\Models\User;
use App\Notifications\FcmNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class NotifServiceController extends Controller
{
    public function saveFcmToken(Request $request)
    {
        $user = $request->user();
        $user->update([
            'fcm_token' => $request->token,
        ]);
    }

    public function testSend(Request $request)
    {
        $users = User::whereNotNull('fcm_token')->get();

        foreach ($users as $user) {
            $user->notify(new FcmNotification(
                "Materi Baru",
                "Ahmad Hidayat Memposting Materi Baru Pada matpel MATEMATIKA"
            ));
        }
    }
}
