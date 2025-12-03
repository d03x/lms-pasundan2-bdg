<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $option = null): Response
    {
        if (!Auth::check()) {
            if (!$request->routeIs('login')) {
                return to_route('login');
            }
        }
        $user = $request->user();
        if ($option) {
            if ($user->role != $option) {
                return to_route('home')->withErrors([
                    'access_forbidden' => "Anda tidak ada aksess untuk mengaksess resource ini!"
                ]);
            }
        }
        if ( $user->guru ){
            $getID = $user->guru->nip;
        }else if($user->siswa){
            $getID = $user->siswa->nis;
        }
        $request->merge([
            'role' => $user->role,
            'role_id' => $getID,
            'kelas' => $user->kelas,
        ]);
        return $next($request);
    }
}
