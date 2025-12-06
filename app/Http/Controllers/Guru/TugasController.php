<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Service\Contract\KelasServiceInterface;
use App\Service\Contract\MatpelServiceInterface;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index(Request $request, string $kelas_id, MatpelServiceInterface $matpelService)
    {
        $guru = $request->user()->id;
        $tugas = Tugas::where('created_by_user_id', $guru)->join('matpels','matpels.kode','=','tugas.matpel_kode')->select(['tugas.*','matpels.nama as nama_matpel'])->get();
        $tug = $tugas->filter(function ($item) use ($kelas_id) {
            if ($item->receiver_type === 'class_id') {
                return collect($item->receiver_type_id)->contains($kelas_id);
            }
            return true;
        });
        return inertia('guru/tugas', [
            'tugas' => $tug
        ]);
    }
    public function __invoke(
        Request $request,
        KelasServiceInterface $kelasService
    ) {
        if (!($request->role == 'guru')) {
            return to_route('home');
        }
        $kelas = $kelasService->getKelasByGuru($request->role_id);
        return inertia('guru/tugas', [
            'kelas' => $kelas,
        ]);
    }
}
