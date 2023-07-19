<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $guarded=[
        'id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
