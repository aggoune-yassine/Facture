<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frournisseur extends Model
{
    //

    public function facturs()
    {
  
      return   $this->hasMany(Facture::class);
    }
  
}
