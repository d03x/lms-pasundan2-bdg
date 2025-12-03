<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Matpel;
use App\Models\User;
use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = Kelas::all()->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            Materi::create([
                'title' => fake()->paragraph(),
                'status' => 'publish',
                'publish_date' => fake()->dateTime(),
                'description' => fake()->paragraph(24),
                'file_materi' => json_encode([
                   "Buku Materi 1" =>  fake()->imageUrl(),
                   "Buku Materi 2" =>  fake()->imageUrl(),
                   "Buku Materi 3" =>  fake()->imageUrl(),
                ]),
                'youtube_id' => uuid_create(),
                'kelas_ids' => json_encode( $kelas),
                'matpel_kode' => Matpel::inRandomOrder()->first()->kode,
                'created_by_user_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
