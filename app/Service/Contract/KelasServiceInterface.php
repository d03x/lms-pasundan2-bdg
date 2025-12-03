<?php

namespace App\Service\Contract;


interface KelasServiceInterface
{
    public function getKelasByGuru(string $nip);
    public function handleFirstMatpel();
    public function get_matpels(string|null $kelas = null) : \Illuminate\Support\Collection ;
}
