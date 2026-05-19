<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'pekerjaan',
        'kondisi_ekonomi',
        'tanggungan',
        'notes',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isJamaah()
    {
        return $this->role === 'jamaah';
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'jamaah_id');
    }

    public function assistanceApplications()
    {
        return $this->hasMany(AssistanceApplication::class, 'jamaah_id');
    }

    public function verifiedApplications()
    {
        return $this->hasMany(AssistanceApplication::class, 'verified_by');
    }

    public function distributions()
    {
        return $this->hasMany(AssistanceDistribution::class, 'distributed_by');
    }

    public function assistanceHistories()
    {
        return $this->hasMany(AssistanceHistory::class, 'jamaah_id');
    }
}
