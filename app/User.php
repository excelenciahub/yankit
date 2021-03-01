<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // implements MustVerifyEmail
{
    use Notifiable;

    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'avatar', 'user_type', 'status', 'address', 'username', 'social_provider', 'social_id', 'social_data', 'email_verified_at', 'dirty',
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

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatarUrlAttribute(){
        $dirty = json_decode($this->dirty, true);
        if($this->social_provider!=''){
            if(! (is_array($dirty) && in_array('avatar', $dirty)) ){
                return $this->avatar;
            }
        }
        return $this->avatar==''?'':url(USER_STORAGE_URL.$this->avatar);
    }
}
