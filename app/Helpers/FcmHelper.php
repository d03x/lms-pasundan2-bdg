<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Http;

class FcmHelper
{
    public static function  sendFcm($token, $title, $body)
    {
        $projectId = getenv("FIREBASE_PROJECT_ID_FCM");
        $serviceAccount = json_decode(file_get_contents(storage_path(getenv("GCLOUD_AUTH_SERVICE_FILE"))), true);
        $now = time();
        // Buat JWT buat auth
        $payload = [
            'iss' => $serviceAccount['client_email'],
            'sub' => $serviceAccount['client_email'],
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now,
            'exp' => $now + 3600,
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging'
        ];

        $jwt = JWT::encode($payload, $serviceAccount['private_key'], 'RS256');

        // Dapatkan access token
        $response = HTTp::asForm()->post('https://oauth2.googleapis.com/token', [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt,
        ]);

        $accessToken = $response->json()['access_token'];
        // Kirim pesan FCM
        return Http::withToken($accessToken)
            ->post(
                "https://fcm.googleapis.com/v1/projects/$projectId/messages:send",
                [
                    "message" => [
                        "token" => $token,
                        "notification" => [
                            "title" => $title,
                            "body" => $body,
                        ]
                    ]
                ]
            )->json();
    }
}
