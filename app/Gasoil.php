<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasoil extends Model
{
    public function kilometrage()
    {
    return $this->belongsTo('App\Kilometrage')->orderBy('date', 'desc');
    }

    public function vehicule()
    {
    return $this->belongsTo('App\Vehicule');
    }
    public function fournisseur()
    {
    return $this->belongsTo('App\Fournisseur');
    }
    public function cuve()
    {
    return $this->belongsTo('App\Cuve');
    }
}
