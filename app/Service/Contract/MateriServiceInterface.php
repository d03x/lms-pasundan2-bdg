<?php

namespace App\Service\Contract;

use Illuminate\Http\Request;

interface MateriServiceInterface
{
    public function simpanMateri(array $data, string $kelas_kode, string $guru_id);
    public function getMateriByGuruDanKelas(string $matpel_kode, string $guru_id,string $kelas_kode);
    public function getDetailMateri( string $id );
    public function getMateri(string $kelas_id, string $matpel_id): \Illuminate\Support\Collection;
}
