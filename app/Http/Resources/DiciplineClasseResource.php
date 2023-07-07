<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiciplineClasseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Discipline'=>new DisciplineResource($this->discipline),
            'evaluation'=> new EvaluationResource($this->evaluation),
            'noteMaximale'=>$this->noteMax,
        ];
    }
}
