<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    public function marque()
    {
    return $this->belongsTo('App\Marque');
    }
    public function vehicule(){
        return $this->hasMany('App\Vehicule');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
