<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Budget;

class Product extends Model
{
    //
    protected $fillable = [
        
        
        'facture_id',
        'description',
        'date_achat',
        'unit_price',
        'qty',
        'budget_id'
    ];
    public function facture()
    {
        $this->belongsTo(Facture::class);
    }

    public function budget(){

        return  $this->belongsTo(Budget::class);
       }
    

}
