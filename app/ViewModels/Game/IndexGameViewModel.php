<?php

namespace App\ViewModels\Game;

class IndexGameViewModel
{
    /** @var array<\App\Models\Game> */
    public $activeGamesPreview;
    /** @var array<\App\Models\Game> */
    public $newGamesPreview;
    /** @var array<\App\Models\Game> */
    public $playerGamesPreview;
    /** @var array<\App\Models\Game> */
    public $finishedGamesPreview;

    public bool $showNewGamesLink;
    public bool $showPlayerGamesLink;
    public bool $showFinishedGamesLink;
    public bool $showRunningGamesLink;

    /**
     * @param  \App\Models\Game[]  $activeGamesPreview
     * @param  \App\Models\Game[]  $newGamesPreview
     * @param  \App\Models\Game[]  $playerGamesPreview
     * @param  \App\Models\Game[]  $finishedGamesPreview
     * @param  bool  $showNewGamesLink
     * @param  bool  $showPlayerGamesLink
     * @param  bool  $showFinishedGamesLink
     * @param  bool  $showRunningGamesLink
     */
    public function __construct(
        $activeGamesPreview,
        $newGamesPreview,
        $playerGamesPreview,
        $finishedGamesPreview,
        bool $showNewGamesLink,
        bool $showPlayerGamesLink,
        bool $showFinishedGamesLink,
        bool $showRunningGamesLink
    ) {
        $this->activeGamesPreview = $activeGamesPreview;
        $this->newGamesPreview = $newGamesPreview;
        $this->playerGamesPreview = $playerGamesPreview;
        $this->finishedGamesPreview = $finishedGamesPreview;
        $this->showNewGamesLink = $showNewGamesLink;
        $this->showPlayerGamesLink = $showPlayerGamesLink;
        $this->showFinishedGamesLink = $showFinishedGamesLink;
        $this->showRunningGamesLink = $showRunningGamesLink;
    }


}
