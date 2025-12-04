<?php

namespace App\Service;

use App\Facades\Youtube;
use App\Models\Materi;
use App\Models\Pengajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MateriService implements MateriServiceInterface
{
    public function getMateri(string $kelas_id, string $matpel_id): Collection
    {
        $materials = Pengajaran::where('materials.matpel_kode', '=', $matpel_id)
            ->join('gurus', 'gurus.nip', '=', 'pengajarans.guru_nip')
            ->join('kelas', 'kelas.id', '=', 'pengajarans.kelas_id')
            ->where('pengajarans.kelas_id', '=', $kelas_id)
            ->join('matpels', 'matpels.kode', '=', 'pengajarans.matpel_kode')
            ->join('users', 'users.id', '=', 'gurus.user_id')
            ->join('materials', 'materials.matpel_kode', 'pengajarans.matpel_kode')
            ->select(['pengajarans.*', 'materials.file_materi', 'materials.nomor_materi', 'kelas.nama  as nama_kelas', 'materials.id as materi_id', 'gurus.gelar_depan', 'gurus.gelar_belakang', 'materials.title', 'materials.kelas_ids', 'matpels.nama as nama_matpel', 'users.name as nama_guru'])
            ->orderBy('materials.nomor_materi', 'desc')
            ->get();

        $data = $materials->filter(function ($materi) use ($kelas_id) {
            $kelas_ids = is_string($materi->kelas_ids)
                ? json_decode($materi->kelas_ids, true)
                : $materi->kelas_ids;

            return collect($kelas_ids)
                ->map(fn($k) => trim(strtolower($k)))
                ->contains(trim(strtolower($kelas_id)));
        });
        $id = request()->user()->id;
        $data->map(function ($data) use ($id) {
            return $data;
        });
        return $data;
    }
    public function getDetailMateri(string $id)
    {
        $materi  = Materi::join('matpels', 'matpels.kode', '=', 'materials.matpel_kode')
            ->join('pengajarans', 'pengajarans.matpel_kode', '=', 'materials.matpel_kode')
            ->join('gurus', 'gurus.nip', '=', 'pengajarans.guru_nip')
            ->join('users', 'users.id', '=', 'gurus.user_id')
            ->where('materials.id', $id)
            ->select([
                'users.name as nama_guru',
                'gurus.user_id',
                'pengajarans.guru_nip',
                'pengajarans.kelas_id',
                'pengajarans.matpel_kode',
                'matpels.nama as nama_matpel',
                'materials.title',
                'materials.nomor_materi as nomor_materi',
                'materials.created_at',
                'materials.description',
                'materials.youtube_id',
                'materials.file_materi'
            ])
            ->first();
        return $materi;
    }
    public function simpanMateri(array $data, string $kelas_kode, string $guru_id)
    {
        $kelass = [];
        if (is_array($data['kelas_ids'])) {
            $kelass = collect($data['kelas_ids'])->pluck('id_kelas');
        }
        $matpel = $data['matpel']['kode_matpel'];
        $nomorMateriTerakhir = $this->getMateri($kelas_kode, $matpel)->max('nomor_materi');
        return Materi::create([
            'title' => $data['title'],
            'created_by_user_id' => $guru_id,
            'status' => "publish",
            'publish_date' => now(),
            'description' => $data['description'],
            'file_materi' =>   $data['file_materi'],
            'youtube_id' => Youtube::parseVideoID($data['youtube_id']),
            'kelas_ids' => $kelass,
            'matpel_kode' => $matpel,
            'nomor_materi' => $nomorMateriTerakhir + 1,
        ]);
    }
}
