<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateGameController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('game.create');
    }
}
