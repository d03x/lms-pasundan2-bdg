<?php

namespace App\Service;

use Illuminate\Http\Request;

interface MateriServiceInterface
{
    public function simpanMateri(array $data, string $kelas_kode, string $guru_id);
    public function getDetailMateri( string $id );
    public function getMateri(string $kelas_id, string $matpel_id): \Illuminate\Support\Collection;
}
