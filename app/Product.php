<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Budget;
use App\facture;
use App\Structure;
use Illuminate\Console\Command;

class Product extends Model
{
    //
    protected $fillable = [
        'id',
        'code',
        'facture_id',
        'description',
        'date',
        'unit_price',
        'commande_id',
        'structure_id',
      

       // 'qty',
        'file',
        'structure',
        'budget_id',
        'status',
        'materiel_id',
    ];
    public function facture()
    {
       return $this->belongsTo(Facture::class);
    }

    public function budget(){

        return  $this->belongsTo(Budget::class);
       }

       public function commande(){

        return  $this->belongsTo(Command::class);
       }

       public function structure(){

        return  $this->belongsTo(Structure::class);
       }
       public function materiel(){

        return  $this->belongsTo(Materiel::class);
       }
    

}
