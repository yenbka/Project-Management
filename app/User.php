<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'admin' ,'password', 'permission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks() {
        return $this->hasMany('App\Task') ;
    }

    public function projects() {
        return $this->hasMany('App\Project') ;
    }

    public function hasDefinePrivilege($permission)
    {
        if (!$permission) {
            return false;
        }

        return $this->permission ==  $permission;
    }


}
