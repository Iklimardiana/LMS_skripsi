<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'firstName',
        'lastName',
        'password',
        'phone',
        'role',
        'gender',
        'avatar',
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

    protected $attributes = [
        'avatar' => 'avatarDefault.png',
    ];

    public function Enrollment()
    {
        return $this->hasMany(Enrollment::class, 'idUser');
    }

    public function Subject()
    {
        return $this->hasMany(Subject::class, 'idTeacher');
    }

    public function Assignment()
    {
        return $this->hasMany(Assignment::class, 'idStudent');
    }

    public function UserAnswer()
    {
        return $this->hasMany(UserAnswer::class, 'idStudent');
    }
}
