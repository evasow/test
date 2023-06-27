<?php
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

// Route::resource('/niveaux', NiveauController::class);

Route::get('/niveaux/{niveau}', [NiveauController::class, 'find']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
