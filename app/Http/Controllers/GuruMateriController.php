<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Matpel;
use App\Models\Pengajaran;
use App\Service\Contract\KelasServiceInterface;
use App\Service\KelasServiceImpl;
use App\Service\MateriServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GuruMateriController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function materi(
        Request $request,
        KelasServiceInterface $kelasService,
        MateriServiceInterface $materiService,
        string|null $kelas_kode = null
    ) {
        $nipGuru = $request->role_id;
        $id = $request->user()->id;
        if ($kelas_kode) {
            $kodeMatpel = $request->kode_matpel;
            $matpel = Pengajaran::join(
                'kelas',
                'kelas.id',
                '=',
                'pengajarans.kelas_id'
            )
                ->join(
                    'matpels',
                    'matpels.kode',
                    '=',
                    'pengajarans.matpel_kode'
                )
                ->where('kelas.id', '=', $kelas_kode)->select([
                    'matpels.kode as kode_matpel',
                    'matpels.nama'
                ])->where('pengajarans.guru_nip', $nipGuru)->get();
            if (!empty($kodeMatpel)) {
                $materi = Materi::where('materials.matpel_kode', $kodeMatpel)
                    ->where('materials.created_by_user_id', '=', $id)
                    ->get();
                $materi = $materi->filter(function ($mater) use ($kelas_kode) {
                    $kelas = is_string($mater->kelas_ids)
                        ? json_decode($mater->kelas_ids, true)
                        : $mater->kelas_ids;
                    return collect($kelas)->contains($kelas_kode);
                })->map(function ($value) {
                    $file_materi = is_string($value->file_materi)
                        ? json_decode($value->file_materi, true)
                        : $value->file_materi;
                    return [
                        ...$value->toArray(),
                        'jumlahFileMateri' => count($file_materi)
                    ];
                })->values();
            }
            return inertia('guru/materi', [
                'matpels' => $matpel,
                'kelas_kode' => $kelas_kode,
                'kode_matpel' => $kodeMatpel,
                'materials' => $materi ?? null,
            ]);
        }
        //get kelas by guru
        $kelas = $kelasService->getKelasByGuru($nipGuru);
        return inertia('guru/pilih-kelas', [
            'kelas' => $kelas,
        ]);
    }
    public function tambahMateri(){
        return inertia('guru/tambah-materi');
    }
}
