<?php

namespace App\Http\Controllers;

use App\Facture;
use App\Product;
use Illuminate\Http\Request;

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
        $product = Product::all();



        return response()->json($product);
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

          
            'facture_id' => $request->id_facture,

            'budget_id' => $request->code_budget,
            'description' => $request->description,

            'date_achat' => $request->date,

            'unit_price' => $request->unit_price,
            'qty' => $request->qty,

        ]);
      //  $product = Product::where('facture_id', $request->id_facture)->orderBy('id', 'desc')->get();

        
       // return response()->json($product);

        $facture = Facture::where('id',$request->id_facture)->get();
        $product= Product::where('facture_id',$request->id_facture)->get();
       $nbr=Product::where('facture_id',$request->id_facture)->sum('qty');

       foreach ($product as $p) {
           $total=$total+($p->unit_price)*($p->qty);
       }
      //  dd($total);
         
        return response()->json([

           // 'facture'=>$facture,
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
        //
        
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {   

      
        $produit = Product::find($id);
        $produit->delete();
       
    }

}
