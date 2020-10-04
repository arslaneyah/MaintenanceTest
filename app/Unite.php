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
    return $this->BelongsTo('App\Wilaya');
    }

}
