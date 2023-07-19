<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'inscriptions'=>$this->inscription,
            "note" => $this->note,
            "semestre"=> $this->semestre_id,
            "discipline_classes"=>new DiciplineClasseResource($this->diciplines_classe)
        ];
    }
}
