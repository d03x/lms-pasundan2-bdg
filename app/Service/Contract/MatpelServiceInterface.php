<?php

namespace App\Service\Contract;

interface MatpelServiceInterface
{
    public function getMatpelByKelasAndGuru(string $kelas_kode, string $nipGuru);
}
