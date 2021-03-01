<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Admin\Notifications\AdminPasswordReset;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password', 'avatar',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);    
    }
    public function getNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }
    public function getAvatarUrlAttribute(){
        return $this->avatar==''?'':url(ADMIN_STORAGE_URL.$this->avatar);
    }
    public function sendPasswordResetNotification($token){
        try{
            $this->notify(new AdminPasswordReset($token));
        }
        catch(\Exception $e){}
    }
}
