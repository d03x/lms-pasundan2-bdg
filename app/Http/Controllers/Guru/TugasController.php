<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Service\Contract\KelasServiceInterface;
use App\Service\Contract\MatpelServiceInterface;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index(Request $request, string $kelas_id, MatpelServiceInterface $matpelService)
    {
        $guru = $request->user()->id;
        $tugas = Tugas::where('created_by_user_id', $guru)
            ->join('matpels', 'matpels.kode', '=', 'tugas.matpel_kode')
            ->select(['tugas.*', 'matpels.nama as nama_matpel'])
            ->when($request->kelas, function ($q) use ($request) {
                $q->where('matpels.kode', $request->kelas);
            })
            ->when($request->keywords, function ($q) use ($request) {
                $q->where('tugas.title', 'LIKE', "%{$request->keywords}%")
                ->orWhere('matpels.nama', 'LIKE', "%{$request->keywords}%");
            })
            ->get();

        $tug = $tugas->filter(function ($item) use ($kelas_id) {
            if ($item->receiver_type === 'class_id') {
                return collect($item->receiver_type_id)->contains($kelas_id);
            }
            return true;
        });
        $info_kelas = Kelas::find($kelas_id);
        $matpel = $matpelService->getMatpelByKelasAndGuru($kelas_id, $request->role_id);
        return inertia('guru/tugas', [
            'info_kelas' => $info_kelas,
            'search_current_terms' => [
                'keywords' => $request->keywords,
                'matpels' => $request->kode_matpel,
            ], 
            'tugas' => $tug,
            'kelas_id' => $kelas_id,
            'matpels' => $matpel,
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
