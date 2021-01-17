<?php

namespace App;
use App\Product;
use App\Commande;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    //


    public function produis()
    {
  
      return   $this->hasMany(Product::class);
    }
    public function commandes()
    {
  
      return   $this->hasMany(Commande::class);
    }
  

    
}
