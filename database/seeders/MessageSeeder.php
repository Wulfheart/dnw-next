<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Message;
use App\Models\MessageRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = Game::with(['powers.messageRooms'])->whereActive()->get();

        // dd($games);

        foreach ($games as $game) {
            foreach ($game->powers as $power) {
                foreach ($power->messageRooms as $messageRoom) {
                    $numOfMessages = fake()->numberBetween(0, 50);
                    for ($i = 0; $i < $numOfMessages; $i++) {
                        Message::create([
                            'sender_id' => $power->id,
                            'message_room_id' => $messageRoom->id,
                            'text' => fake()->paragraphs(fake()->biasedNumberBetween(1, 3), true),
                            'created_at' => fake()->dateTimeBetween($game->created_at),
                        ]);
                    }

                    // Message::insert($messages);
                }

            }
        }
    }
}
