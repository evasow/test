<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiciplinesClasse extends Model
{
    use HasFactory;

    protected $guarded=[
        'id',
    ];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }


}
