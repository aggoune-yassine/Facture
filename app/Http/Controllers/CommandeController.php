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
        
   
   
       
      
        if (request('q') != null) {


            $Commandes['data'] = Commande::where('code_decharge', 'like', '%' . request('q') . '%')->get();

            foreach ($Commandes['data'] as $commande) {

                //  dd($commande->structure);
                  $commande->setattribute('user', $commande->user);
                  $commande->setattribute('structure', $commande->structure);
                  $commande->setattribute('created', $commande->created_at->diffForHumans());
              }


              return response()->json($Commandes);
        }
        Carbon::setLocale('fr');
      $Commandes = Commande::latest()->paginate('3');

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
        
          
        

      ]);

      
        Commande::create([
            'file'=>'/storage/decharge/' . $request->code_decharge.'.pdf' ,
            'user_id' => $request->user_id,
            'structure_id'=>$request->structure_id,
            'code_decharge'=>$request->code_decharge,

           



        ]);

        $request->decharge->move(public_path('storage/decharge'), $request->code_decharge.'.pdf');
        $commande = Commande::orderBy('id', 'desc')->get();


       return response()->json($commande);

        // dd($name);
    }



    public function Produit_commande(commande $commande)


    {



        $produits=$commande->products;

        return response()->json(['produits'=>$produits,'commande'=>$commande]);

       
    }

    public function updatefile(commande $commande , Request $request){

        if(($request->hasFile('decharge')))
        {
     
     
         
     
     
        $name=$commande->commande.'.pdf';
           $request->decharge->move(public_path('/storage/decharge'),$name);
           $commande->update(['file'=>'/storage/decharge/'.$name]);
         
     } 

    }

    public function destroy( Commande $commande)
    {   


        $message=true;
        $commande->delete();



      return response()->json(['message'=>$message]);
       
    }

    
    
}
