<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Pengajaran;
use App\Service\Contract\KelasServiceInterface;
use App\Service\Contract\MatpelServiceInterface;
use App\Service\MateriServiceInterface;
use App\Service\MatpelService;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class GuruMateriController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function materi(
        Request $request,
        KelasServiceInterface $kelasService,
        MateriServiceInterface $materiService,
        MatpelServiceInterface $matpelService,
        string|null $kelas_kode = null
    ) {
        $nipGuru = $request->role_id;
        $id = $request->user()->id;
        if ($kelas_kode) {
            $kodeMatpel = $request->kode_matpel;
            $matpel = $matpelService->getMatpelByKelasAndGuru($kelas_kode, $nipGuru);
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
        $kelas = $kelasService->getKelasByGuru($nipGuru);
        return inertia('guru/pilih-kelas', [
            'kelas' => $kelas,
        ]);
    }
    public function tambahMateri(string $kelas_kode, Request $request, MatpelServiceInterface $matpelService, KelasServiceInterface $kelasService)
    {
        $nipGuru = $request->role_id;
        $matpels = $matpelService->getMatpelByKelasAndGuru($kelas_kode, $nipGuru);
        $kelas = $kelasService->getKelasByGuru($nipGuru);

        return inertia('guru/tambah-materi', [
            'matpels' => $matpels,
            'kelas' => $kelas,
            'kelas_kode' => $kelas_kode,
        ]);
    }
    public function simpanMateri(Request $request, string $kelas_kode, MateriServiceInterface $materiService)
    {
        $id = $request->user()->id;

        $data = $request->validate([
            'title' => 'string|required',
            'matpel' => "required",
            'youtube_id' => "string|required",
            'kelas_ids' => ['required'],
            'description' => "string|required",
            'file_materi' => ["nullable"]
        ]);
        $kelass = [];
        if (is_array($request->kelas_ids)) {
            $kelass = collect($request->kelas_ids)->pluck('id_kelas');
        }

        $matpel = $request->matpel['kode_matpel'];
        $nomorMateriTerakhir = $materiService->getMateri($kelas_kode, $matpel)->max('nomor_materi');

        Materi::create([
            'title' => $data['title'],
            'created_by_user_id' => $id,
            'status' => "publish",
            'publish_date' => now(),
            'description' => $data['description'],
            'file_materi' =>   $data['file_materi'],
            'youtube_id' => $data['youtube_id'],
            'kelas_ids' => $kelass,
            'matpel_kode' => $matpel,
            'nomor_materi' => $nomorMateriTerakhir + 1,
        ]);



        return redirect()->back()->withErrors([
            'success' => "Materil berhasil di tambahkan"
        ]);
    }
}
