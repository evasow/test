<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Discipline;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        NiveauSeeder::class,
        ClasseSeeder::class,
        DisciplineSeeder::class,
        EvaluationSeeder::class,
        SemestreSeeder::class,
       ]);
    }
}
