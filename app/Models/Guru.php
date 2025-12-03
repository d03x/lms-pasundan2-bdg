<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    /** @use HasFactory<\Database\Factories\GuruFactory> */
    use HasFactory;
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'nip',
        'jenis_kelamin',
        'status',
        'gelar_depan',
        'gelar_belakang',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
