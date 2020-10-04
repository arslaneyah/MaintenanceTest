<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    public function marque()
    {
    return $this->belongsTo('App\Marque');
    }
}
