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

    public function kilometrage()
    {
    return $this->hasMany('App\Kilometrage');
    }
    public function alimentation_cuve()
    {
    return $this->hasMany('App\Alimentation_Cuve');
    }
    public function unite(){
        return $this->belongsTo('App\unite');
    }
    public function marque()
    {
        return $this->belongsTo('App\Marque');
    }
    public function modele(){
        return $this->belongsTo(App\Modele);
    }
    public function vehicule(){
        return $this->belongsTo(App\Vehicule);
    }
}
