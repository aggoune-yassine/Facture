<?php

namespace App\Http\Controllers;
use App\Facture;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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


        if(request('idstructure'))  {

         

          $produits=Product::where('structure_id','like',request('idstructure'))->whereNull('commande_id')->get();
       //   return response()->json(['data'=>$produits]);

       foreach( $produits as $produit){
        $produit->setattribute('created',$produit->created_at->diffForHumans());
      
        $produit->setattribute('facture',$produit->facture);
        $produit->setattribute('user',$produit->facture->user);
   
    }

      return response()->json(['data'=>$produits]);


        }

       
        if(request('q') OR request('status') ) 

        {
          if(empty(request('status')))

          {
            
            $produits =Product::where('code','like', '%'.request('q').'%')->
           
            
            get();

          }
          else 
          {

         

          $produits =Product::where('code','like', '%'.request('q').'%')->
          where('status','like',request('status'))
          ->
          get();
        }

          foreach( $produits as $produit){
            $produit->setattribute('created',$produit->created_at->diffForHumans());
          
            $produit->setattribute('facture',$produit->facture);
            $produit->setattribute('user',$produit->facture->user);
       
        }

          return response()->json(['data'=>$produits]);
        }
        
        $produits = Product::latest()->paginate('4');
        //$produits = Product::all();

        foreach( $produits as $produit){
            $produit->setattribute('created',$produit->created_at->diffForHumans());
          
            $produit->setattribute('facture',$produit->facture);
            $produit->setattribute('user',$produit->facture->user);

       
        }

      //dd($produits);
   
        return response()->json($produits);
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
        //
        $total=0;

        Product::create([
            'code'=>$request->code,
          
            'facture_id' => $request->id_facture,

            'budget_id' => $request->code_budget,
            'description' => $request->description,

            'date_achat' => $request->date,

            'unit_price' => $request->unit_price,
         //   'qty' => $request->qty,

        ]);
      //  $product = Product::where('facture_id', $request->id_facture)->orderBy('id', 'desc')->get();

        
       // return response()->json($product);

        $facture = Facture::where('id',$request->id_facture)->get();
        $product= Product::where('facture_id',$request->id_facture)->get();
      $nbr=Product::where('facture_id',$request->id_facture)->count();

       foreach ($product as $p) {
           $total=$total+($p->unit_price)*($p->qty);
       }
      //  dd($total);
         
        return response()->json([

          
            'produits'=>$product,
            'nbr'=>$nbr,
            'total'=>$total
            
          
            
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
      

  
    
    
       $fournisseur= $product->facture->fournisseur;
$facture=$product->facture;
   
 
    $sum=Product::where('facture_id',$product->facture_id)->sum('unit_price');

    return response()->json(['product'=>$product,'montant_facture'=>$sum,'fournisseur'=>$fournisseur,'facture'=>$facture]);


        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    
    //dd($request->file->getClientOriginalName());

    //dd($product);

   //$name=$product->id.$request->file->getClientOriginalExtension();
  
   if(($request->hasFile('file')))
   {


    


   $name=$product->id.'.pdf';
      $request->file->move(public_path('fiche_mouvement'),$name);
      $product->update(['file'=>'/fiche_mouvement/'.$name,'structure'=>$request->structure]);
    //Storage::put('/fiche_mouvement/file.pdf', $request->file);
     
 //  Product::where('id',$product->id)->update(['file'=>$request->file],['structure'=>$request->structure]);
} }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( Product $product)
    {   

      $message=true;
      //  $produit = Product::find($id);
      // dd($product->structure);

       if($product->structure>0)

       {
     $message=false;


       }
       else

       {
        $product->delete();



       }
      return response()->json(['message'=>$message]);
       
    }


    public function supp_produit_decharge(Product  $product)

    {

       
//dd($product);
        $product->update([
     'commande_id'=> null

        ]);
    }


    public function addbon()

    {
    if(request('tab')  and ('idbon'))
    {

      $tab=request('tab');
      $id=request('idbon');
      

      foreach(  $tab as $element )
      {
         Product::where('id','like',$element)->update(['commande_id'=>$id]);
      }
    }
    }

}
