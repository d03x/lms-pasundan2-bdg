<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $nip = str_pad(mt_rand(0, 9999999999), 8, '0', STR_PAD_LEFT);
            $siswa = Guru::create([
                'nip' => $nip,
                'jenis_kelamin' => fake()->randomElement(['L', 'P']),
                'gelar_depan' => fake()->randomElement(['','Dr.','Ir.','Drs.','Dra.']),
                'gelar_belakang' => fake()->randomElement(['S.kom.','M.Kom.','S.Si.','S.Psi.','M.Psi.']),
                'status' => fake()->randomElement(['aktif', 'nonaktif']),
            ]);
            $user =  User::factory()->create([
                'name' => fake('id-ID')->name(),
                'email' => sprintf('%s@smkpasundanbdg.sch.id', $siswa->nip),
            ]);
            $siswa->update([
                'user_id' => $user->id,
            ]);
        }
    }
}
