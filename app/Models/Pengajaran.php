<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajaran extends Model
{
    protected $fillable = ['guru_nip', 'matpel_kode', 'kelas_id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function matpel()
    {
        return $this->belongsTo(Matpel::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
