<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "nom" => $this->libelle,
            "date"=>$this->date_event,
            // "user"=> new UserResource($this->user),
            // "participants"=> $this->participants
            // "classe"=> new ParticipantResource($this->participants),
            
        ];
    }
}
