<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Http\Request;
use App\Http\Resources\NiveauResource;
use App\Traits\JoinQueryParams;


class NiveauController extends Controller
{
    
    use JoinQueryParams;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $niveau=new Niveau();
        // $relations=$niveau->getRelations();
        // return $relations;
        $this->test($niveau , $request, ['classes','eleves','notes']);
        // return;
        // $classes = in_array('classes', $joins);
        // $niveau=new Niveau();
    //   if (!$this->test($niveau , $request, ['classes','eleves'])) {

          return NiveauResource::collection(Niveau::all());

    //   }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {
        return $niveau->load('classes');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Niveau $niveau)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        //
    }
}
