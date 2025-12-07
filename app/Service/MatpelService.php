<?php

namespace App\Service;

use App\Models\Pengajaran;
use App\Service\Contract\MatpelServiceInterface;

class MatpelService implements MatpelServiceInterface
{
    public function getMatpelByKelasAndGuru(string $kelas_kode, string $nipGuru)
    {
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
        return $matpel;
    }

    public function getMatpelByGuru(string $guruNip)
    {
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
            )->groupBy(['matpels.kode'])->select([
                'matpels.kode as kode_matpel',
                'matpels.nama'
            ])->where('pengajarans.guru_nip', $guruNip)->get();
        return $matpel;
    }
}
