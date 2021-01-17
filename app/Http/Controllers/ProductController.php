<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Facture;

use App\Product;
use Carbon\Carbon;
use File;
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
     
       foreach( $produits as $produit){
        $produit->setattribute('created',$produit->created_at->diffForHumans());
      
        $produit->setattribute('facture',$produit->facture);
        $produit->setattribute('user',$produit->facture->user);
   
                           }

      return response()->json(['data'=>$produits]);


        }


        if((request('q') ))

        {
          
          $produits =Product::where('code','like', '%'.request('q').'%')->
         
          
          get();
          foreach( $produits as $produit){
            $produit->setattribute('created',$produit->created_at->diffForHumans());
            $produit->setattribute('facture',$produit->facture);
            $produit->setattribute('user',$produit->facture->user);

        }
        return response()->json(['data'=>$produits]);
      
        }

           if((request('type_id')))

          {
           
          
            $produits =Product::where('materiel_id','like', request('type_id'))-> get();
            foreach( $produits as $produit){
              $produit->setattribute('created',$produit->created_at->diffForHumans());
              $produit->setattribute('facture',$produit->facture);
              $produit->setattribute('user',$produit->facture->user);

          }
          return response()->json(['data'=>$produits]);
        

   
        }

        if((request('status') ))

        {

        

          if(request('status')=='2')
          {
            
            $produits =Product::whereNull('structure_id')->whereNull('commande_id')->whereNull('file')->
         
          
            get();
          }

          if(request('status')=='3')
          {
            
            $produits =Product::whereNotNull('structure_id')->whereNotNull('commande_id')->whereNotNull('file')->
         
          
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
   
        foreach( $produits as $produit){
            $produit->setattribute('created',$produit->created_at->diffForHumans());
          
            $produit->setattribute('facture',$produit->facture);
            $produit->setattribute('user',$produit->facture->user);

       
        }

     
   
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
        $this->validate($request,[
          'code'=>'required|unique:products|max:255',
          'description'=>'required|max:255',
          
          'unit_price'=>'required',
          
          'date'=>'required',
          
          'budget_id'=>'required',
          'materiel_id'=>'required'


        ]);
     
       



        Product::create([
            'code'=>$request->code,
            'materiel_id'=>$request->materiel_id,
          
            'facture_id' => $request->id_facture,

            'budget_id' => $request->budget_id,
            'description' => $request->description,

            'date' => $request->date,

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
       $structure=$product->structure;
   
   
    $sum=Product::where('facture_id',$product->facture_id)->sum('unit_price');

    return response()->json(['product'=>$product,'montant_facture'=>$sum,'fournisseur'=>$fournisseur,'facture'=>$facture,'structure'=>$structure]);


        
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
      $request->file->move(public_path('/storage/fiche_mouvement'),$name);
      $product->update(['file'=>'/storage/fiche_mouvement/'.$name,'structure_id'=>$request->structure]);
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


    public function suppfile(Product $product) {

    
      File::delete(public_path($product->file));

      $product->update(['file' => null]);
  
   
    }

}
