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
    'paye',

    'fournisseur_id',
    'description',
    



    'piece_depense',
   'facture',
 
   'Bon_de_livraison',
    'Ordre_de_service',
   'Bon_de_commande',
    'Caution',
   'Pv_reception_provisoire',
    'Pv_de_reception',
    'Contrat',
    'proforma',

    

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
