<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use App\Notifications\MyResetPassword;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','apellido','username','web','direccion', 'email','user_creador_id', 'password','type_user_id','path_foto','registration_token','deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    public function sendPasswordResetNotification($token)
//    {
//        $this->notify(new MyResetPassword($token));
//    }

    public function usersxnegocio()
    {
        return $this->hasOne('App\Shelter\Entities\UsersXNegocio','user_creador_id','id');
    }



}
