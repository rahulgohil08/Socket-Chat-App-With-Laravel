<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $guarded = [];


    protected $hidden = [
        'password',
    ];


    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = bcrypt($pass);
    }


    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

}
