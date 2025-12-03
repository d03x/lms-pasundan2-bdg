<?php

namespace App\Service;

use App\Dto\LoginRequestDto;
use App\Service\Contract\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthServiceImpl implements AuthServiceInterface
{
    public function validateLogin(LoginRequestDto $data)
    {
        if (Auth::attempt($data->toArray(), true)) {
            return to_route('home');
        }
        throw ValidationException::withMessages([
            'email' => __("auth.failed")
        ]);
    }
    public function getCurrentRole()
    {
        if( Auth::check() ){
            $user = Auth::user();
            $siswa = $user->siswa;
            dd($siswa);
        }
        return "OKE";
    }
}
