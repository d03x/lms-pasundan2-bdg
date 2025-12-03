<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tingkat = [10, 11, 12];

        $kelas = [
            10 => "X TKJ 1",
            10 => "X TKJ 2",
            10 => "X TKJ 3",
            10 => "X TKJ 4",
            11 => "XI TKJ 1",
            11 => "XI TKJ 2",
            11 => "XI TKJ 3",
            11 => "XI TKJ 4",
            11 => "XI TKJ 5",
            12 => "XII TKJ 1",
            12 => "XII TKJ 2",
            12 => "XII TKJ 3",
            12 => "XII TKJ 4",
        ];

        foreach ($kelas as $key => $value) {
            Kelas::create([
                'nama' => $value,
                'tingkat' => $key
            ]);
        }
    }
}
