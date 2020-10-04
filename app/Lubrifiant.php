<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lubrifiant extends Model
{
    public function vehicule()
    {
    return $this->belongsTo('App\Vehicule');
    }
}
