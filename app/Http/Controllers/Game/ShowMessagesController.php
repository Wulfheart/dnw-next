<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\MessageRoom;
use Illuminate\Http\Request;

class ShowMessagesController extends Controller
{
    public function __invoke(Request $request, Game $game, MessageRoom $messageRoom)
    {
        //
    }
}
