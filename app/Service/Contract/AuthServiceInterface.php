<?php

namespace App\Service\Contract;

use App\Dto\LoginRequestDto;
use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function validateLogin(LoginRequestDto $request);
    public function getCurrentRole();
}
