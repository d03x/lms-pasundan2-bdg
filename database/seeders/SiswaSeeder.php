<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $nis = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $siswa = Siswa::create([
                'nis' => $nis,
                'jenis_kelamin' => fake()->randomElement(['L', 'P']),
                'agama' => fake()->randomElement(['islam', 'kristen', 'hindu']),
                'tahun_masuk' => fake()->year(),
                'tingkat' => fake()->randomElement([10, 11, 12]),
                'status' => fake()->randomElement(['aktif', 'lulus', 'keluar', 'tinggal_kelas']),
                'kelas_id' => Kelas::inRandomOrder()->first()->id,
            ]);
            $user =  User::factory()->create([
                'name' => fake('id-ID')->name(),
                'email' => sprintf('%s@smkpasundanbdg.sch.id', $siswa->nis),
            ]);
            $siswa->update([
                'user_id' => $user->id,
            ]);
        }
    }
}
