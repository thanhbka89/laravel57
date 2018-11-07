<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

    #mutator
    // public function setPasswordAttribute($password)
    // {   
    //     $this->attributes['password'] = bcrypt($password);
    // }
     
    #accessor : [get][Tên thuộc tính][Attribute]
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Lấy tên đầy đủ của người dùng
     *
     * @return bool
     */
    public function getFullNameAttribute()
    {
        return $this->attributes['name'] . '>>>' . $this->attributes['email'];
    }
}
