<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    public function modele()
    {
    return $this->HasMany('App\Modele');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
