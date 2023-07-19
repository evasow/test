<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        dd(Auth::user()->can('viewAny', $request));
        
        // $events=  EventResource::collection(Event::all());
        return Event::all();
    //    $users=EventResource::collection(Event::with('user')->get());
        // return $events;
        // foreach ($users as $user) {
        //     // echo ($user->user()->get()[0]->email);
        //     return $user;
        // }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd(Auth::user()->can('create', $request));
        return Event::firstOrCreate([
            "libelle" => $request->libelle,
            "user_id" => $request->user_id,
            "date_event" => $request->date_event,
            "description" => $request->description
        ]);
    }

    public function participation(Request $request, Event $event)
    {
        return Participant::firstOrCreate([
            "classe_id" => $request->classe_id,
            "event_id" => $event->id,
        ]);
    }
    public function sendMail(){

        return  EventResource::collection(Event::all());

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
