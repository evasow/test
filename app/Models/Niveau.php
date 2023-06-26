<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;


    public function Niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
}
