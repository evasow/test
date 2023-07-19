<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function Classes()
    {
        return $this->hasMany(Classe::class);
    }
    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'inscriptions','classe_id','eleve_id');
    }
    public function notes()
    {
        return $this->belongsToMany(Note::class, 'inscriptions','classe_id','eleve_id');
    }
    
}
