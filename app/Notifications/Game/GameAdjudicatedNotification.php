<?php

namespace App\Notifications\Game;

use App\Models\Game;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GameAdjudicatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Game $game
    ) {
        $this->game->loadMissing('variant');
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Spiel ausgewertet')
            ->markdown('mail.markdown.game.adjudicated', [
                'gameName' => $this->game->name,
                'url' => route('games.show', $this->game),
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'game_id' => $this->game->id,
            'game_name' => $this->game->name,
            'variant' => $this->game->variant->name,
        ];
    }
}
