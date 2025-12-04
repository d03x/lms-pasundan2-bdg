<?php

namespace App\Http\Controllers;

use App\Facades\Youtube;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Pengajaran;
use App\Service\Contract\KelasServiceInterface;
use App\Service\Contract\MatpelServiceInterface;
use App\Service\MateriService;
use App\Service\MateriServiceInterface;
use App\Service\MatpelService;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class GuruMateriController extends Controller
{
    /**
     * Handle the incoming request to retrieve learning materials for a specific class and subject.
     *
     * This method checks if a class code is provided. If it is, it retrieves the corresponding 
     * subject materials created by the teacher associated with the given class code. It filters 
     * the materials based on the class IDs and returns them along with the subject information 
     * to the 'guru/materi' view. If no class code is provided, it retrieves the classes 
     * associated with the teacher and returns them to the 'guru/pilih-kelas' view.
     *
     * @param Request $request The incoming request containing user and role information.
     * @param KelasServiceInterface $kelasService Service for retrieving class information.
     * @param MateriServiceInterface $materiService Service for handling learning materials.
     * @param MatpelServiceInterface $matpelService Service for retrieving subject information.
     * @param string|null $kelas_kode The class code to filter materials (optional).
     *
     * @return \Inertia\Response The response containing either the materials view or the class selection view.
     */

    public function materi(
        Request $request,
        KelasServiceInterface $kelasService,
        MatpelServiceInterface $matpelService,
        MateriService $materiService,
        string|null $kelas_kode = null
    ) {
        $nipGuru = $request->role_id;
        $userId = $request->user()->id;
        if ($kelas_kode) {
            $kodeMatpel = $request->kode_matpel;
            $matpel = $matpelService->getMatpelByKelasAndGuru(
                $kelas_kode,
                $nipGuru
            );
            if (!empty($kodeMatpel)) {
                $materi = $materiService->getMateriByGuruDanKelas(
                    $kodeMatpel,
                    $userId,
                    $kelas_kode
                );
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
    /**
     * Menambahkan materi untuk kelas tertentu.
     *
     * @param string $kelas_kode Kode kelas yang akan ditambahkan materinya.
     * @param Request $request Objek request yang berisi data yang diperlukan.
     * @param MatpelServiceInterface $matpelService Layanan untuk mengambil data mata pelajaran.
     * @param KelasServiceInterface $kelasService Layanan untuk mengambil data kelas.
     *
     * @return \Inertia\Response Mengembalikan respons Inertia dengan data yang diperlukan untuk tampilan.
     *
     * Fungsi ini mengambil data mata pelajaran berdasarkan kode kelas dan NIP guru,
     * serta mengambil data kelas yang diajarkan oleh guru tersebut. 
     * Kelas aktif kemudian disiapkan untuk ditampilkan dalam tampilan.
     */
    public function tambahMateri(
        string $kelas_kode,
        Request $request,
        MatpelServiceInterface $matpelService,
        KelasServiceInterface $kelasService
    ) {
        $nipGuru = $request->role_id;
        $matpels = $matpelService->getMatpelByKelasAndGuru($kelas_kode, $nipGuru);
        $kelas = $kelasService->getKelasByGuru($nipGuru);
        $kelasActive = $kelasService->getActiveClass($kelas_kode);
        return inertia('guru/tambah-materi', [
            'matpels' => $matpels,
            'kelas' => $kelas,
            'kelas_kode' => $kelas_kode,
            'active_kelas' => $kelasActive,
        ]);
    }
    public function simpanMateri(
        Request $request,
        string $kelas_kode,
        MateriServiceInterface $materiService
    ) {
        $id = $request->user()->id;

        $data = $request->validate([
            'title' => 'string|required',
            'matpel' => "required",
            'youtube_id' => "string|required|url",
            'kelas_ids' => ['required'],
            'description' => "string|required",
            'file_materi' => ["nullable"]
        ]);

        if ($materiService->simpanMateri($data, $kelas_kode, $id)) {
            return redirect()->back()->withErrors([
                'success' => "Materil berhasil di tambahkan"
            ]);
        }
        return redirect()->back()->withErrors([
            'gagal' => "Materil berhasil di tambahkan"
        ]);
    }
}
