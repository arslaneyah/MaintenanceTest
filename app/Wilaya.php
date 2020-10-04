<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{

    public function unite()
    {
    return $this->hasMany('App\Unite');
    }
}
