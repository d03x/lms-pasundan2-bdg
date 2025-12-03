<?php

namespace App\Dto;

use Illuminate\Http\Request;
/**
 * Login Request DTO
 * @author dadan hidayat
 */
class LoginRequestDto
{
    public string $email;
    public string $password;
    public function fromRequest(Request $request)
    {
        $this->email = $request->email;
        $this->password = $request->password;
    }
    public function toArray(){
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
