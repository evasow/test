<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Symfony\Component\VarDumper\VarDumper;

class Eleve extends Model
{
    use HasFactory;

    public function __construct()
    {
        // $this->numero=$this->numero();
    //    echo json_encode($this->numero());
        // $this->numero();
    }

    protected $guarded=[
        'id'
    ];
    
    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    private function numero()
    {
        $eleves = DB::table('eleves')
        ->where('etat', 1)
        ->where('profile', 1)
        ->orderBy('numero', 'asc')
        ->pluck('numero')
        ->toArray();
        // echo json_encode($eleves);

        $i = 0;
        foreach ($eleves as $eleve) {
            // echo json_encode($eleve);
            if ($eleve > $i + 1) {

                return $i+1;
            }
            $i=$eleve;
            
        }
        return $i+1;
    }

    public function scopeSortie(Builder $builder, array $idEleves, $sens)
    {
        return $builder->whereIn('id',$idEleves)->update(['etat'=>$sens]);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
}
