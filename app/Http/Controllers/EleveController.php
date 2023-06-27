<?php

namespace App\Http\Controllers;

use App\Http\Requests\EleveRequest;
use App\Models\Eleve;
use Illuminate\Http\Request;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EleveRequest $request)
    {
        $eleve = Eleve::firstOrCreate([
            "Nom" => $request->input("Nom"),
            "Prenom" => $request->input("Prenom"),
            "dateNaiss" => $request->input("dateNaiss"),
            "LieuNaiss" => $request->input("LieuNaiss"),
            "sexe"=>$request->input("sexe"),
            "profile"=>$request->input("profile")
        ]);
        return $eleve;
    }

    /**
     * Display the specified resource.
     */
    public function show(Eleve $eleve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eleve $eleve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eleve $eleve)
    {
        //
    }
}
