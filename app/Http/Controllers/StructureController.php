<?php

namespace App\Http\Controllers;

use App\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    //

    public function index()
    {
        //
        $structure=Structure::all();

        //dd($Frournisseur);

        

       

        return response()->json($structure);
    }
}
