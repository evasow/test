<?php

namespace Database\Seeders;

use App\Models\Semestre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semestres = [
            [
                "libelle" => "Semestre 1",
            ],
            [
                "libelle" => 'Semestre 2'
            ],
            [
                "libelle" => 'Semestre 3'
            ]
        ];
        Semestre::insert($semestres);
    }
}
