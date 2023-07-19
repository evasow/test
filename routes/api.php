<?php

use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\UserController;
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

Route::apiResource('/niveaux', NiveauController::class);

// Route::get('/niveaux/{niveau}', [NiveauController::class, 'find']);

Route::name("eleve.sortie")->put('eleves/sortie', [EleveController::class, 'sortieEleve']);
Route::get('eleves/{elefe}/participations', [EleveController::class, 'eleveParticipations']);
Route::apiResource('eleves', EleveController::class);//->only(['store','index']);

Route::apiResource('annees', AnneeScolaireController::class)->only(['store','index']);
Route::apiResource('disciplines', DisciplineController::class)->only(['store','index']);
Route::apiResource('evaluations', EvaluationController::class)->only(['store','index']);

// Route::POST('classes', [ClasseController::class, 'insertDisciplineClasse']);
Route::POST('classes/{classes}/disciplines/{disciplines}/evals/{evals}',[ClasseController::class, 'insertNote']);
Route::PUT('classes/{classes}/disciplines/{disciplines}/evals/{evals}/eleves/{elefe}', [ClasseController::class, 'update']);
Route::POST('classes/{classe}/coef', [ClasseController::class, 'insertDisciplineClasse']);
Route::GET('classes/{class}/notes', [ClasseController::class, 'notesClasse']);
ROUTE::GET('classes/{class}/disciplines/{discipline}/notes', [ClasseController::class, 'noteDisciplineClasse']);
Route::GET('classes/{class}/notes/eleves/{elefe}', [ClasseController::class, 'notesEleve']);
Route::apiResource('/classes', ClasseController::class);


Route::GET('/classes/{classe}/eleves', [ClasseController::class, 'eleves']);
Route::GET('/classes/{classe}/coef', [ClasseController::class, 'coef']);
// Route::GET('/classes/{classe}', [ClasseController::class, 'show']);

Route::POST('events/{event}/participations', [EventController::class, 'participation']);
Route::GET('events/sendMail', [EventController::class, 'sendMail']);
Route::group(['middleware' => 'admin'], function() {
    Route::apiResource('events', EventController::class)->except('index');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::POST('login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('users', [UserController::class,'index']);
    Route::apiResource('events', EventController::class)->only('index','store');

    Route::get('logout',[UserController::class,'logout']);
});
Route::get('users/{user}/evenements', [UserController::class,'userEvenements']);
Route::apiResource('users', UserController::class)->except([('index')]);
    
    

