<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatpelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matpel = [
            // Normatif
            ['kode' => 'N001', 'nama' => 'Pendidikan Agama', 'kategori' => 'Normatif'],
            ['kode' => 'N002', 'nama' => 'Bahasa Indonesia', 'kategori' => 'Normatif'],
            ['kode' => 'N003', 'nama' => 'PPKN', 'kategori' => 'Normatif'],
            ['kode' => 'N004', 'nama' => 'PJOK', 'kategori' => 'Normatif'],
            ['kode' => 'N005', 'nama' => 'Sejarah Indonesia', 'kategori' => 'Normatif'],

            // Adaptif
            ['kode' => 'A001', 'nama' => 'Matematika', 'kategori' => 'Adaptif'],
            ['kode' => 'A002', 'nama' => 'Bahasa Inggris', 'kategori' => 'Adaptif'],
            ['kode' => 'A003', 'nama' => 'IPA', 'kategori' => 'Adaptif'],
            ['kode' => 'A004', 'nama' => 'Seni Budaya', 'kategori' => 'Adaptif'],
            ['kode' => 'A005', 'nama' => 'Simulasi Digital', 'kategori' => 'Adaptif'],

            // Produktif TKJ
            ['kode' => 'P001', 'nama' => 'Komputer & Jaringan Dasar', 'kategori' => 'Produktif'],
            ['kode' => 'P002', 'nama' => 'Pemrograman Dasar', 'kategori' => 'Produktif'],
            ['kode' => 'P003', 'nama' => 'Sistem Komputer', 'kategori' => 'Produktif'],
            ['kode' => 'P004', 'nama' => 'Administrasi Infrastruktur Jaringan', 'kategori' => 'Produktif'],
            ['kode' => 'P005', 'nama' => 'Administrasi Sistem Jaringan', 'kategori' => 'Produktif'],
            ['kode' => 'P006', 'nama' => 'Teknologi Layanan Jaringan', 'kategori' => 'Produktif'],
            ['kode' => 'P007', 'nama' => 'Jaringan Nirkabel', 'kategori' => 'Produktif'],
            ['kode' => 'P008', 'nama' => 'Keamanan Jaringan', 'kategori' => 'Produktif'],
            ['kode' => 'P009', 'nama' => 'Produk Kreatif & Kewirausahaan', 'kategori' => 'Produktif'],
            ['kode' => 'P010', 'nama' => 'Sistem Operasi', 'kategori' => 'Produktif'],
            ['kode' => 'P011', 'nama' => 'Cloud Computing', 'kategori' => 'Produktif'],
            ['kode' => 'P012', 'nama' => 'Praktek TJKT', 'kategori' => 'Produktif'],
        ];

        DB::table('matpels')->insert($matpel);
    }
}
