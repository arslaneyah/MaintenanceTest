<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    public function gasoil()
    {
    return $this->HasMany('App\Gasoil');
    }
    public function alimentation_cuve()
    {
    return $this->HasMany('App\Alimentation_Cuve');
    }
}
