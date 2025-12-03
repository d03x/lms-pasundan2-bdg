<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaFactory> */
    use HasFactory;
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $siwh = ['kelas'];
    protected $keyType = 'string';
    protected $fillable = [
        'nis',
        'user_id',
        'jenis_kelamin',
        'agama',
        'tahun_masuk',
        'tingkat',
        'pas_photo',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
