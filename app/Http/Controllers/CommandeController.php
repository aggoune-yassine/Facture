<?php

namespace App\Http\Controllers;

use App\Commande;
use App\Product;
use App\Structure;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CommandeController extends Controller
{
    //



    public function index()
    {
        //
       // dd('index');
        
   
   
        Carbon::setLocale('fr');
        $Commandes = Commande::latest()->paginate('1');

      

        foreach ($Commandes as $commande) {

          //  dd($commande->structure);
            $commande->setattribute('user', $commande->user);
            $commande->setattribute('structure', $commande->structure);
            $commande->setattribute('created', $commande->created_at->diffForHumans());
        }


    
        return response()->json($Commandes);
    }



    public function store(Request $request)
    {


       
      $this->validate($request,[
          
         'structure_id'=>'required',
          'user_id'=>'required|integer',
        
          
        

      ]
      
      );
        Commande::create([

            'user_id' => $request->user_id,
            'structure_id'=>$request->structure_id,

           



        ]);
        $commande = Commande::orderBy('id', 'desc')->get();


       return response()->json($commande);

        // dd($name);
    }



    public function Produit_commande(commande $commande)


    {



        $produits=$commande->products;

        return response()->json(['produits'=>$produits,'commande'=>$commande]);

       
    }

    
    
}
