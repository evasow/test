<?php

use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\NiveauController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('/niveaux', NiveauController::class);

// Route::get('/niveaux/{niveau}', [NiveauController::class, 'find']);

Route::name("eleve.sortie")->put('eleves/sortie', [EleveController::class, 'sortieEleve']);
Route::apiResource('eleves', EleveController::class);//->only(['store','index']);

Route::apiResource('annees', AnneeScolaireController::class)->only(['store','index']);
Route::apiResource('disciplines', DisciplineController::class)->only(['store','index']);
Route::apiResource('evaluations', EvaluationController::class)->only(['store','index']);

// Route::POST('classes', [ClasseController::class, 'insertDisciplineClasse']);
Route::POST('classes/{classes}/disciplines/{disciplines}/evals/{evals}',[ClasseController::class, 'insertNote']);
Route::POST('classes/{classe}/coef', [ClasseController::class, 'insertDisciplineClasse']);
Route::apiResource('/classes', ClasseController::class);


Route::GET('/classes/{classe}/eleves', [ClasseController::class, 'eleves']);
Route::GET('/classes/{classe}/coef', [ClasseController::class, 'coef']);
// Route::GET('/classes/{classe}', [ClasseController::class, 'show']);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
