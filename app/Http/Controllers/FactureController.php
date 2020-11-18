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
       // dd('index');
        
        if (request('q') != null) {



            $factures['data'] = Facture::where('facture_code', 'like', '%' . request('q') . '%')->get();

            foreach ($factures['data'] as $facture) {


                $facture->setattribute('produits', $facture->produits);

                foreach ($facture->produits as $produit) {
                    # code...
                    $produit->setattribute('created', $produit->created_at->diffForHumans());
                }

                $facture->setattribute('user', $facture->user);
                $facture->setattribute('created', $facture->created_at->diffForHumans());
            }


            return response()->json($factures);
        }

        Carbon::setLocale('fr');
        $factures = Facture::latest()->paginate('2');

        foreach ($factures as $facture) {



            $facture->setattribute('produits', $facture->produits);

            foreach ($facture->produits as $produit) {
                # code...
                $produit->setattribute('created', $produit->created_at->diffForHumans());
            }

            $facture->setattribute('user', $facture->user);
            $facture->setattribute('created', $facture->created_at->diffForHumans());
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
        
        Facture::create([

            'user_id' => $request->user_id,
            'facture_code' => $request->code_facture,

            'fournisseur_id' => $request->fournisseur_id,
            'description' => $request->description,
           

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
       // dd('show');


        //dd($facture);
        // $facture->produits->sum('unit_price');

        foreach ($facture->produits as $produit) {
            $produit->setattribute('budget', $produit->budget);
        }

        $facture->setattribute('produits', $facture->produits);


        $facture->setattribute('fournisseur', $facture->fournisseur);
        $facture->setattribute('total', $this->refresh($facture));
        //$facture->setattribute('nbr',$facture->produits->sum('qty'));




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

       
        if ($request->hasFile('Piece_depense'))
        {  
           
  
        $facture->update([

            'Piece_depense' => 'piece_depense/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->Piece_depense,'piece_depense',$facture->facture_code);
        }
   
  
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
        $priceTotal = 0;


        foreach ($facture->produits as $f) {
            $price = $f->unit_price;
            $priceTotal = $priceTotal + $price;
        }
        return  $priceTotal;
    }


    public function Ajouter_fichier( $file ,$dossier,$code)
    
    {


     
       
       $file->move(public_path($dossier), $code.'.pdf');
    }
}
