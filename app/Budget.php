<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    //

       
    public function produits (){

        return   $this->hasMany(Product::class);
         }
}
