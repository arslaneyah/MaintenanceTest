<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kilometrage extends Model
{
    public function gasoil()
    {
    return $this->HasMany('App\Gasoil');
    }
    public function vehicule()
    {
    return $this->belongsTo('App\Vehicule');
    }
    public function user()
    {
    return $this->belongsTo('App\User');
    }

}
