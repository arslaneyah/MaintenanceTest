<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimentation_Cuve extends Model
{
    protected $table="alimentation_cuves" ;
    public function cuve()
    {
    return $this->belongsTo('App\Cuve');
    }
    public function fournisseur()
    {
    return $this->belongsTo('App\Fournisseur');
    }
    public function user()
    {
    return $this->belongsTo('App\User');
    }

    
}
