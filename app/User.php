<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lname',
        'preferred_name',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'postcode',
        'type',
        'remember_token',
        'gender',
        'avatar',
        'status',
        'calendar_default_view',
        'message',
        'lesson_travel_time'
    ];

    public function user_meta()
    {
        return $this->hasOne('App\UserMeta');
    }
}
