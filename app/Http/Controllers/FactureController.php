<?php

namespace App\Http\Controllers;

use App\Facture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use File;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Carbon::setLocale('fr');
        $factures = Facture::latest()->paginate('5');

        foreach ($factures as $facture) {

            # code...
            $facture->setattribute('user',$facture->user);
            $facture->setattribute('created',$facture->created_at->diffForHumans());
        }



        return response()->json($factures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $name=null;
        if($request->hasFile('piece_d'))
        {
           // dd($request->piece_d);

            $name=$request->code_facture.'.'.$request->piece_d->getClientOriginalExtension();
           $request->piece_d->move(public_path('piece_depense'),$name);

        }

        $url=explode('/',url()->current());
    //  dd($url);
       Facture::create([
            
            'user_id' => $request->user_id,
            'facture_code' => $request->code_facture,

            'fournisseur_id' => $request->fournisseur_id,
            'description' => $request->description,
            'piece_depence' => 'piece_depense/'.$name,

            'date' => $request->date,



        ]);
       $facture = Facture::orderBy('id', 'desc')->get();


       return response()->json($facture);

       // dd($name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        //
   
           
      //dd($facture);
       // $facture->produits->sum('unit_price');

       foreach ( $facture->produits as $produit)
       {
         $produit->setattribute('budget',$produit->budget);
       }
       
       $facture->setattribute('produits',$facture->produits);


       $facture->setattribute('fournisseur',$facture->fournisseur);
       $facture->setattribute('total', $this->refresh($facture));
       $facture->setattribute('nbr',$facture->produits->sum('qty'));

   
        

        return response()->json(
            $facture
           
         //   'fournisseur'=>$facture->fournisseur,
         //   'total'=> $this->refresh($facture),
         //   'nbr'=>$facture->produits->sum('qty')
            
            
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {

        dd($facture);
        //
        //$produits = $facture->produits;
        //$facture=Facture::where('id',$facture->);
        /*

        return response()->json([
           
            'fournisseur'=>$facture->fournisseur,
            'total'=> $this->refresh($facture),
            'nbr'=>$facture->produits->sum('qty')
            
            ]
        );*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facture $facture)
    {


      
      $name=$facture->facture_code.'.pdf';
        if($request->hasFile('piece_d'))
        {
           // dd($request->piece_d);

            $name=$request->code_facture.'.'.$request->piece_d->getClientOriginalExtension();
           $request->piece_d->move(public_path('piece_depense'),$name);

        }

        $url=explode('/',url()->current());
    //  dd($url);
       $facture->update([
            
            'user_id' => '1',
            'facture_code' => $request->code_facture,

            'fournisseur_id' => $request->fournisseur_id,
            'description' => $request->description,
            'piece_depence' => 'piece_depense/'.$name,

            'date' => $request->date,



        ]);
       $facture = Facture::orderBy('id', 'desc')->get();


       return response()->json($facture);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {

        ///dd($facture);
        //
       // Facture::delete();
      //  Facture::where('id', $facture->id)->delete();
   
        File::delete($facture->piece_depence);
        $facture->delete();
    }
    public  function refresh(Facture $facture)
    {
        $priceTotal=0;
        

        foreach($facture->produits as $f){
            $price = $f->unit_price *  $f->qty ;
            $priceTotal = $priceTotal + $price;
            }
            return  $priceTotal;

    }
}
