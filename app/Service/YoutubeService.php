<?php

namespace App\Service;

class YoutubeService
{
    /**
     * Create a new class instance.
     */
    public function parseVideoID(string $url)
    {
        if (!$url) return null;

        $url = trim($url);

        // Jika user langsung memasukkan ID (11 karakter)
        if (preg_match('/^[A-Za-z0-9_-]{11}$/', $url)) {
            return $url;
        }

        $patterns = [
            '/[?&]v=([A-Za-z0-9_-]{11})/',                 // watch?v=
            '/youtu\.be\/([A-Za-z0-9_-]{11})/',            // youtu.be/
            '/youtube\.com\/embed\/([A-Za-z0-9_-]{11})/',  // embed/
            '/youtube\.com\/v\/([A-Za-z0-9_-]{11})/',      // /v/
            '/youtube\.com\/shorts\/([A-Za-z0-9_-]{11})/', // shorts/
            '/(?:youtube\.com|youtu\.be).*?([A-Za-z0-9_-]{11})/' // fallback
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
}
