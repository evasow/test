<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use PHPUnit\TextUI\XmlConfiguration\Validator;

class AnneeScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AnneeScolaire::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'libelle' => 'bail|required|string|max:10',
        ]);

        $anneeScolaire = AnneeScolaire::firstOrCreate([
            "libelle" => $request->input("libelle")
        ]);
        return $anneeScolaire;
    }
    /**
     * Display the specified resource.
     */
    public function show(AnneeScolaire $anneeScolaire)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnneeScolaire $anneeScolaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnneeScolaire $anneeScolaire)
    {
        
    }
}
