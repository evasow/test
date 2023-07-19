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
        $classes = ['6eme','5eme','4eme','3eme'];
        
        
        $primaire= Niveau::where('id',2)->first();
               
            foreach ($classes as $classe) {
                DB::table("classes")->insert([

                    "libelle" =>$classe,
                    "niveau_id" =>$primaire->id
                ]);
            }
    }
}
