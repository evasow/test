<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $guarded=[
        'id',
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
