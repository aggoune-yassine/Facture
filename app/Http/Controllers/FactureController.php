<?php

namespace App\Http\Controllers;

use DB;
use File;
use App\Facture;
use Carbon\Carbon;
use Illuminate\Http\Request;


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
        $factures = Facture::latest()->paginate('4');

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

      $this->validate($request,[
          'facture_code'=>'required|unique:factures|max:255',
          'description'=>'required|max:255',
          'fournisseur_id'=>'required|integer',
          'paye'=>'required',
          
          'date'=>'required|date',


      ]
      
      );
        Facture::create([

            'user_id' => $request->user_id,
            'facture_code' => $request->facture_code,

            'fournisseur_id' => $request->fournisseur_id,
            'description' => $request->description,
           

            'date' => $request->date,
            'paye'=>$request->paye



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
  

        $facture->update([
         'paye'=>$request->paye,
         'fournisseur_id'=>$request->fournisseur_id,
         'date'=>$request->date


        ]);
  
       
        if ($request->hasFile('Piece_depense'))
        {  
           
  
        $facture->update([

            'Piece_depense' => '/storage/Piece_depense/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->Piece_depense,'piece_depense',$facture->facture_code);
        }
     else if ($request->hasFile('facture'))
        {  
           
  
        $facture->update([

            'facture' => '/storage/facture/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->facture,'facture',$facture->facture_code);
        }
   
       if ($request->hasFile('Bon_de_livraison'))
        {  
           
  
        $facture->update([

            'Bon_de_livraison' => '/storage/Bon_de_livraison/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->Bon_de_livraison,'Bon_de_livraison',$facture->facture_code);
        }
        if ($request->hasFile('Ordre_de_service'))
        {  
           
  
        $facture->update([

            'Ordre_de_service' => '/storage/Ordre_de_service/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->Ordre_de_service,'Ordre_de_service',$facture->facture_code);
        }
        if ($request->hasFile('Bon_de_commande'))
        {  
           
  
        $facture->update([

            'Bon_de_commande' => '/storage/Bon_de_commande/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->Bon_de_commande,'Bon_de_commande',$facture->facture_code);
        }
        if ($request->hasFile('Caution'))
        {  
           
  
        $facture->update([

            'Caution' => '/storage/Caution/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->Caution,'Caution',$facture->facture_code);
        }
        if ($request->hasFile('Pv_reception_provisoire'))
        {  
           
  
        $facture->update([

            'Pv_reception_provisoire' => '/storage/Pv_reception_provisoire/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->Pv_reception_provisoire,'Pv_reception_provisoire',$facture->facture_code);
        }
        if ($request->hasFile('Pv_de_reception'))
        {  
           
  
        $facture->update([

            'Pv_de_reception' => '/storage/Pv_de_reception/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->Pv_de_reception,'Pv_de_reception',$facture->facture_code);
        }

        if ($request->hasFile('Contrat'))
        {  
           
  
        $facture->update([

            'Contrat' => '/storage/Contrat/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->Contrat,'Contrat',$facture->facture_code);
        }
        if ($request->hasFile('Contrat'))
        {  
           
  
        $facture->update([

            'Pv_de_reception' => '/storage/Pv_de_reception/' . $facture->facture_code.'.pdf' ]);
        
        
            $this->Ajouter_fichier($request->Contrat,'Pv_de_reception',$facture->facture_code);
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

        //dd($facture);

       if( $facture->produits()->count()==0)

       {
   $message=true;

        File::delete($facture->Piece_depense);
        File::delete($facture->facture);
        File::delete($facture->Bon_de_livraison);
        File::delete($facture->Ordre_de_service);
        File::delete($facture->Bon_de_commande);
        File::delete($facture->Caution);
        File::delete($facture->Pv_reception_provisoire);
        File::delete($facture->Pv_de_reception);
        File::delete($facture->Contrat);
        File::delete($facture->proforma);


    
        $facture->delete();

       }

       else

       {
           $message=false;
       }
return response()->json(['message'=>$message]);

        //
        // Facture::delete();
        //  Facture::where('id', $facture->id)->delete();

      
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


     
       
       $file->move(public_path('storage/'.$dossier), $code.'.pdf');
    }

    public function deletefile( Facture $facture,Request $request){
     

      //  dd($this->getStringBetween(substr($request->src,8),'/','/'));
         
          $facture->update([$this->getStringBetween(substr($request->src,8),'/','/') => null]);
  
        File::delete(public_path($request->src));
   


    }

    

function getStringBetween($str,$from,$to)
{
    $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
    return substr($sub,0,strpos($sub,$to));
}

   
      
}
