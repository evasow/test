<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClasseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'eleves'=> InscriptionResource::collection($this->inscriptions),
            // 'classe'=>$this->libelle,
            // 'NoteEvaldisciplines'=> DiciplineClasseResource::collection($this-> disciplinesClasse),
            // 'participants'=>ParticipantResource::collection($this->participants)

            'classe'=>$this->libelle,
            'eleves'=> InscriptionResource::collection($this->inscriptions),
            'NoteEvaldisciplines'=> $this->whenLoaded('disciplinesClasse'),
            'participants'=>$this->whenLoaded('participants'),
        ];
    }
}
