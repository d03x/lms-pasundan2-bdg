<?php

namespace App\Notifications\Channels;

use App\Helpers\FcmHelper;

class FcmChannel
{
    protected $fcm;

    public function __construct() {}

    public function send($notifiable, $notification)
    {
        if (! $token = $notifiable->routeNotificationFor('fcm', $notification)) {
            return;
        }
        dump($token);
        $data = $notification->toFcm($notifiable);
        $response = FcmHelper::sendFcm(
            $token,
            $data['title'],
            $data['body'],
        );
        dd($response);
        die;
        return $response;
    }
}
