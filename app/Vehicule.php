<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    public function gasoil()
    {
    return $this->hasMany('App\Gasoil');
    }
    public function pneu()
    {
    return $this->hasMany('App\Pneu');
    }
    public function piece()
    {
    
    return $this->hasMany('App\Piece');
    }
    public function lubrifiant()
    {
    return $this->hasMany('App\Lubrifiant');
    }
    public function unite()
    {    
    return $this->belongsTo('App\Unite');
    }

    public function kilometrage()
    {
    return $this->belongsTo('App\Kilometrage');
    }

}
