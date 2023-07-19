<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'niveau_id'
    ];
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'inscriptions');
    }

    public function disciplinesClasse()
    {
        return $this->hasMany(DiciplinesClasse::class);
    }
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
    public function notes()
    {
        return $this->belongsToMany(Note::class, 'inscriptions','classe_id','eleve_id');
    }
   
  
}
