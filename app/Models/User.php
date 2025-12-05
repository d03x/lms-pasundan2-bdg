<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $appends = ['role', 'nama', 'kelas'];
    protected $fillable = [
        'name',
        'fcm_token',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }
    public function guru()
    {
        return $this->hasOne(Guru::class, 'user_id', 'id');
    }
    public function role(): Attribute
    {
        return Attribute::make(get: function () {
            if ($this->siswa) {
                return 'siswa';
            } else if ($this->guru) {
                return 'guru';
            } else if ($this->is_admin) {
                return 'admin';
            }
            return 'user';
        });
    }
    public function kelas(): Attribute
    {
        return Attribute::make(get: function () {
            if ($this->siswa && $this->siswa->kelas) {
                return [
                    'id' => $this->siswa->kelas->id,
                    'nama' => $this->siswa->kelas->nama
                ];
            }
            return;
        });
    }
    public function nama(): Attribute
    {
        return Attribute::make(get: function () {
            if ($this->guru) {
                return $this->guru->gelar_depan . " " . $this->name . " " . $this->gelar_belakang;
            }
            return $this->name;
        });
    }
    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }
}
