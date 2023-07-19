<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // "classe" => $this->classe,
            // "classe_id" => $this->classe_id,

            // "classes" => ClasseResource::collection($this->classes),
            // "event" => new EventResource($this->event)
            "libelle" => $this->event->libelle,
            "date"=>$this->event->date_event,

        ];
    }
}
