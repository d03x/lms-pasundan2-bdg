<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shetabit\Visitor\Traits\Visitable;

class Pengajaran extends Model
{
    use Visitable;
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
