<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Inscription;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\EleveRequest;
use App\Http\Resources\ParticipantResource;
use App\Models\Classe;
use App\Models\Participant;
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
    public function eleveParticipations(Eleve $elefe)
    {
        // return $elefe->id;
        $idClasse=Inscription::where('id',$elefe->id)->pluck('classe_id')->first();
        // return $idClasse;
        $idParticipation= Participant::where('classe_id',$idClasse)->get();
        // return $idParticipation;
        $libelleClasse=Classe::where('id',$idClasse)->pluck('libelle')->first();
        $idParticipation=  $idParticipation->groupBy('classe_id');

        $classe = Classe::find($idClasse);
        $events = $classe->participants;

        return [
            'classe' => $libelleClasse,
            'events' =>ParticipantResource::collection($events)
        ];
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
            "email"=>$request->input("email"),
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
