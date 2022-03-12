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
        'name', 'email', 'password',
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

    public function trainer()
    {
        return $this->hasOne(Trainer::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
