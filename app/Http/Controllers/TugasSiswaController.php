<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TugasSiswaController extends Controller
{
    public function __invoke()
    {
        return inertia('siswa/tugas');
    }
}
