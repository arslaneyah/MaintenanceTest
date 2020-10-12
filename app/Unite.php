<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    public function vehicule()
    {
    return $this->hasMany('App\Vehicule');
    }
    public function wilaya()
    {
    return $this->belongsTo('App\Wilaya');
    }
    public function user(){
        return $this->hasMany('App\User');
    }
    public function cuve(){
        return $this->hasMany('App\Cuve');
    }

}
