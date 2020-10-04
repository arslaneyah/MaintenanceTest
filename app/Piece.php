<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    public function vehicule()
    {
    return $this->belongsTo('App\Vehicule');
    }
}
