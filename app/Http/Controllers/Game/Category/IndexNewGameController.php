<?php

namespace App\Http\Controllers\Game\Category;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class IndexNewGameController extends Controller
{
    public function new(Request $request)
    {
        $games = Game::whereNew()->loadForIndexPages()->get();
        return view('game.category.index', [
            'games' => $games,
            'title' => 'Neue Spiele'
        ]);
    }

    public function active(Request $request)
    {
        $games = Game::whereActive()->loadForIndexPages()->get();
        return view('game.category.index', [
            'games' => $games,
            'title' => 'Laufende Spiele'
        ]);
    }

    public function player(Request $request)
    {
        $games = Game::whereUserIsMember(auth()->user())->loadForIndexPages()->get();
        return view('game.category.index', [
            'games' => $games,
            'title' => 'Deine Spiele'
        ]);
    }

    public function finished(Request $request)
    {
        $games = Game::whereFinished()->loadForIndexPages()->get();
        return view('game.category.index', [
            'games' => $games,
            'title' => 'Fertige Spiele'
        ]);
    }
}
