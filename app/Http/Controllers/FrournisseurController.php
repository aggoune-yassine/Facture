<?php

namespace App\Http\Controllers;

use App\Frournisseur;
use Illuminate\Http\Request;

class FrournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Frournisseur=Frournisseur::all();

        //dd($Frournisseur);

        

       

        return response()->json($Frournisseur);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Frournisseur  $frournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Frournisseur $frournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Frournisseur  $frournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Frournisseur $frournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Frournisseur  $frournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frournisseur $frournisseur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Frournisseur  $frournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frournisseur $frournisseur)
    {
        //
    }
}
