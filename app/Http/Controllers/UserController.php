<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EventResource;


class UserController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return User::all();
        // return Auth::user();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->role;
        return User::firstOrCreate([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
            "role" => $request->role
        ]);
    }
    public function logout(): Response
    {
        $user = Auth::user();
        
        $user->currentAccessToken()->delete();
        
        return Response(['data' => 'User Déconnecté avec succés !'],200);
    }
    public function userEvenements(User $user)
    {
        return  $user->load('event');
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        // return response($user, Response::HTTP_NO_CONTENT);
        return json_encode([
            "user" => $user,
            "response" => Response::HTTP_NO_CONTENT,
            "message" =>'user supprimé avec succés'
        ]);
    }
}
