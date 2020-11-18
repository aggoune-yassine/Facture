<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Budget;
use App\facture;

class Product extends Model
{
    //
    protected $fillable = [
        'id',
        'code',
        'facture_id',
        'description',
        'date_achat',
        'unit_price',
       // 'qty',
        'file',
        'structure',
        'budget_id'
    ];
    public function facture()
    {
       return $this->belongsTo(Facture::class);
    }

    public function budget(){

        return  $this->belongsTo(Budget::class);
       }
    

}
