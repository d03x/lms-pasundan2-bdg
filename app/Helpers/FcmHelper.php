<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache; // Import Cache
use Illuminate\Support\Facades\Storage;

class FcmHelper
{
    public static function sendFcm($token,  $title, $body)
    {
        if (empty($to)) {
            $to = config("app.url");
        }
        $accessToken = Cache::remember('fcm_access_token', 3300, function () {
            return self::getGoogleAccessToken();
        });
        $projectId = env("FIREBASE_PROJECT_ID_FCM");
        $response = Http::withToken($accessToken)
            ->post(
                "https://fcm.googleapis.com/v1/projects/$projectId/messages:send",
                [
                    "message" => [
                        "token" => $token,
                        "notification" => [
                            "title" => $title,
                            "body"  => $body,

                        ],
                        // "webpush" => [
                        //     "fcmOptions" => [
                        //         "link" => "https://appkamu.com/halaman-tujuan"
                        //     ]
                        // ]
                    ]
                ]
            );

        return $response->json();
    }

    private static function getGoogleAccessToken()
    {
        $credentialsPath = storage_path(env("GCLOUD_AUTH_SERVICE_FILE"));

        if (!file_exists($credentialsPath)) {
            throw new \Exception("File Service Account tidak ditemukan di: " . $credentialsPath);
        }

        $serviceAccount = json_decode(file_get_contents($credentialsPath), true);

        $now = time();
        $payload = [
            'iss' => $serviceAccount['client_email'],
            'sub' => $serviceAccount['client_email'],
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now,
            'exp' => $now + 3600,
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging'
        ];

        $jwt = JWT::encode($payload, $serviceAccount['private_key'], 'RS256');

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt,
        ]);

        return $response->json()['access_token'];
    }
}
