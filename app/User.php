<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'reputation'
    ];

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

    public function profile() {
        return $this->hasOne('App\Profile');
    }

    public function pertanyaans() {
        return $this->hasMany('App\Pertanyaan', 'user_id');
    }

    public function jawabans() {
        return $this->hasMany('App\Jawaban', 'user_id');
    }

    public function komentar_pertanyaan() {
        return $this->hasMany('App\KomentarPertanyaan', 'user_id');
    }
}
