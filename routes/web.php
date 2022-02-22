<?php

use App\Actions\Game\CreateGameAction;
use App\Actions\Game\JoinGameAction;
use App\Actions\Game\SubmitOrdersAction;
use App\Http\Controllers\Game\Category\IndexNewGameController;
use App\Http\Controllers\Game\IndexGameController;
use App\Http\Controllers\Game\JoinGameController;
use App\Http\Controllers\Game\LeaveGameController;
use App\Http\Controllers\Game\SubmitOrdersController;
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

Route::get('/test', function () {
    return view('test');
});

Route::get('/info', fn() => phpinfo());

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('games.index');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('games')->name('games.')->group(function () {
        Route::get('create', \App\Http\Controllers\Game\CreateGameController::class)->name('create');
        Route::get('/', IndexGameController::class)->name('index');
        Route::name('category.')->group(function () {
            Route::get('new', [IndexNewGameController::class, 'new'])->name('new');
            Route::get('active', [IndexNewGameController::class, 'active'])->name('active');
            Route::get('player', [IndexNewGameController::class, 'player'])->name('player');
            Route::get('finished', [IndexNewGameController::class, 'finished'])->name('finished');
        });
        Route::post('/', CreateGameAction::class)->name('store');
        Route::post('/{game}/orders', SubmitOrdersController::class)->name('orders.store');
        Route::post('/{game}/join', JoinGameController::class)->name('join');
        Route::post('/{game}/leave', LeaveGameController::class)->name('leave');
        Route::get('/{game}', \App\Http\Controllers\Game\ShowGameController::class)->name('show');
        // Route::get('/{game}/messages')->name('show.messages.index');
        // Route::get('/{game}/messages/test')->name('show.messages.show');
    });
});
