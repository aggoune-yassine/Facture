<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    //

    protected $fillable = [


        'structure_id',
        'user_id',
       
      ];


    public function products()

    {

        return $this->hasMany(Product::class);
    }
    public function user()

    {

        return $this->belongsTo(User::class);
    }


    public function structure(){

        return  $this->belongsTo(Structure::class);
       }


}
