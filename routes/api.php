<?php

use App\Http\Controllers\EntitiesController;
use App\Http\Controllers\EntriesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/entries', [EntriesController::class, 'getEntries'])->name('api.entries.get');

Route::get('{category}', [EntitiesController::class, 'getEntitiesByCategory'])->name('api.entities.get');