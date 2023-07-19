<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $guarded=[
        'id',
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function note()
    {
        return $this->hasMany(Note::class);
    }
}
