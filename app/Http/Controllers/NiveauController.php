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
        
        $load= Niveau::all();
        $value=$request->query('join');
        
        if ($value=='classes') {
            // return Niveau::with($value)->get();
            return $load->load($value);
        }
        else{
            return NiveauResource::collection(Niveau::all());
        }

    }


    public function find(Niveau $niveau)
    {
        $this->test();
        return $niveau->load('classes');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Niveau $niveau)
    {
        //
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
