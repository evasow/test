<?php

namespace Database\Seeders;
use App\Models\Niveau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = ['CI','CP','CE1','CE2','CM1','CM2'];
        
        
        $primaire= Niveau::where('id',1)->first();
               
            foreach ($classes as $classe) {
                DB::table("classes")->insert([

                    "libelle" =>$classe,
                    "niveau_id" =>$primaire->id
                ]);
            }
    }
}
