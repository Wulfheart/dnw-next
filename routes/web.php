<?php

use App\Actions\Game\CreateGameAction;
use App\Http\Controllers\Game\IndexGameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (){
    return view('test');
});

Route::get('/info', fn() => phpinfo());

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::prefix('games')->name('games.')->group(function(){
        Route::get('create', \App\Http\Controllers\Game\CreateGameController::class)->name('create');
        Route::get('/', IndexGameController::class)->name('index');
        Route::post('/', CreateGameAction::class)->name('store');
        Route::get('/{game}', \App\Http\Controllers\Game\ShowGameController::class)->name('show');
        Route::get('/{game}/messages')->name('show.messages.index');
        Route::get('/{game}/messages/test')->name('show.messages.show');
    });
});
