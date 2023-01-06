<?php

namespace App\Notifications\Game;

use App\Models\Game;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GameFinishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Game $game
    ) {
        $this->game->loadMissing('variant');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Spiel beendet')
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
