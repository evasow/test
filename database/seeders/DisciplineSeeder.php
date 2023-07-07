<?php

namespace Database\Seeders;

use App\Models\Discipline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $disciplines = [
            [
                "libelle" => "Mathemathique",
            ],
            [
                "libelle" => 'Français'
            ],
            [
                "libelle" => 'Anglais'
            ]
        ];
        Discipline::insert($disciplines);
    }
}
