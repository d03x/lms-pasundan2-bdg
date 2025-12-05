<?php

namespace App\Notifications\Channels;

use App\Helpers\FcmHelper;
use Illuminate\Support\Facades\Log;

class FcmChannel
{
    public function __construct() {}

    public function send($notifiable, $notification)
    {
        if (! $token = $notifiable->routeNotificationFor('fcm', $notification)) {
            return;
        }

        $data = $notification->toFcm($notifiable);

        $response = FcmHelper::sendFcm(
            $token,
            $data['title'],
            $data['body'],
        );

        if (isset($response['error'])) {

            $errorCode = $response['error']['details'][0]['errorCode'] ?? '';
            $httpCode = $response['error']['code'] ?? 0;

            // Jika Token Unregistered atau Not Found (404)
            if ($errorCode === 'UNREGISTERED' || $httpCode == 404) {

                Log::warning("FCM Token Invalid/Unregistered. Menghapus token: " . $token);

                // ======================================================
                // TODO: HAPUS TOKEN DARI DATABASE DI SINI
                // ======================================================
                // Anda harus menyesuaikan ini dengan cara Anda menyimpan token.
                // Contoh jika token ada di kolom 'fcm_token' di tabel users:

                if (method_exists($notifiable, 'update')) {
                    // Opsi A: Jika 1 user cuma punya 1 token (kolom)
                    // $notifiable->update(['fcm_token' => null]);
                }

                // Opsi B: Jika Anda punya tabel terpisah 'user_devices'
                // \App\Models\UserDevice::where('token', $token)->delete();
            }

            // Opsional: Log error lain
            Log::error('FCM Error: ' . json_encode($response));

            return null; // Gagal kirim
        }

        return $response;
    }
}
