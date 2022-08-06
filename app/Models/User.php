<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function jemaat()
    {
        return $this->hasOne(Jemaat::class, 'user_id', 'id');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'created_by', 'id');
    }

    public function getPIC()
    {
        return $this->hasMany(Schedule::class, 'pic', 'id');
    }

    public function getGuest()
    {
        return $this->hasMany(ScheduleDetail::class, 'user_id', 'id');
    }

}