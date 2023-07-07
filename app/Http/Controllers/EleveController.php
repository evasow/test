<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Inscription;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\EleveRequest;
use Symfony\Component\HttpFoundation\Request;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $test= new Eleve;
        // return $test->numero();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EleveRequest $request)
    {
        // $test= new Eleve;
       
        $eleve = Eleve::firstOrCreate([
            "Nom" => $request->input("Nom"),
            "Prenom" => $request->input("Prenom"),
            "dateNaiss" => $request->input("dateNaiss"),
            "LieuNaiss" => $request->input("LieuNaiss"),
            "sexe"=>$request->input("sexe"),
            "profile"=>$request->input("profile"),
            "etat"=>true,
        ]);
        
        $lastInsertId=$eleve->id;

        Inscription::firstOrCreate([
           "eleve_id"=>$lastInsertId,
           "classe_id"=> $request->input("classe_id"),
           "dateInscription"=>Now(),
           "annee_scolaire_id"=>1,
        ]);
        return $eleve;
    }

    public function sortieEleve(Request $request)
    {
        ["ids"=>$idEleves]=$request;
        // dd($idEleves);
        // Eleve::whereIn('id',$idEleves)->update(['etat'=>0]);
        Eleve::sortie($idEleves,0);

        return $idEleves;

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
