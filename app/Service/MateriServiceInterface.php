<?php

namespace App\Service;

interface MateriServiceInterface
{
    public function getDetailMateri( string $id );
    public function getMateri(string $kelas_id, string $matpel_id): \Illuminate\Support\Collection;
}
