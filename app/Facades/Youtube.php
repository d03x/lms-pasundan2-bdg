<?php

namespace App\Facades;

use App\Service\YoutubeService;
use Illuminate\Support\Facades\Facade;

class Youtube extends Facade
{
    /**
     * Create a new class instance.
     */
    public static function getFacadeAccessor()
    {
        return YoutubeService::class;
    }
}
