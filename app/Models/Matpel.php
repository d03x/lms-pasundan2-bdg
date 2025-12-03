<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matpel extends Model
{
    /** @use HasFactory<\Database\Factories\MatpelFactory> */
    use HasFactory;
    protected $fillable = [
        'kode',
        'nama',
        'kategori'
    ];
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'kode';

    public function guru(){
        return $this->belongsToMany(Guru::class,'pengajarans','guru_nip');
    }
}
