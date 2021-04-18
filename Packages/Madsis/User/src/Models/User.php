<?php

namespace Madsis\User\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Madsis\User\Mail\MailResetPasswordToken;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\MustVerifyEmail;

class User extends Authenticatable implements JWTSubject
{
    use CanResetPassword,Notifiable,MustVerifyEmail;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['nombres', 'apellidos','username', 'password','email', 'is_active','last_login','last_login_ip'];
	protected $hidden = ['password', 'remember_token'];
    protected $dates = ['deleted_at'];

    public  function  getJWTIdentifier() {
        return  $this->getKey();
    }
    public  function  getJWTCustomClaims() {
        return [];
    }
    public function identificacion(){
        return $this->hasOne(Identificacion::class, 'USUID','id');
    }
    public static function UserNacionalidad($id){
        return Identificacion::where('USUID','=',$id)->get();
    }
    public function sendPasswordResetNotification($token){
        $this->notify(new MailResetPasswordToken($token));
    }
    public function usr_ventas(){
        return $this->hasMany(Sale::class, 'USU','id');
    }
    public function UsuarioPadre($id){
        return Team::where('name',$id)->first()->Usuario()->first();
    }
    public function parent(){
        return $this->belongsTo(User::class, 'usuariopadre');
    }
    public function parentRecursive(){
        return $this->parent()->with('parentRecursive');
    }
    public function children(){
        return $this->hasMany(User::class, 'usuariopadre')->with('children');
    }
    public function childrenRecursive(){
        return $this->children()->with('childrenRecursive');
    }
}
