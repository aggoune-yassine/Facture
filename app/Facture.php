<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{

  //protected $guarded = [];
  protected $fillable = [


    'facture_code',
    'user_id',

    'fournisseur_id',
    'description',
    'Piece_depense',
    

    'date',
    'created_at',
    'updated_at'
  ];


  public function produits()
  {

    return   $this->hasMany(Product::class);
  }

  public function user()
  {

    return  $this->belongsTo(User::class);
  }

  public function fournisseur()
  {

    return  $this->belongsTo(Frournisseur::class);
  }
}
