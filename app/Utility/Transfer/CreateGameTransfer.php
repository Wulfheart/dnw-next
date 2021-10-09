<?php


namespace App\Utility\Transfer;


use Illuminate\Foundation\Http\FormRequest;

class CreateGameTransfer
{
    public function __construct(
        public ?int $variant_id,
        public int $scs_to_win,
        public int $phase_length,
        public int $join_phase_length,
        public bool $end_forming_phase_when_enough_players,
        public bool $allow_power_selection,
        public bool $display_power_names,
        public bool $has_manual_orders,
        public string $message_mode_name,
        public string $message_mode_description,
        public ?int $message_mode_template_id,
        public bool $message_mode_room_creation_allowed,
        public bool $message_mode_signing_allowed,
        public bool $message_mode_adjustment_messages_allowed,
        public bool $message_mode_move_messages_allowed,
        public bool $message_mode_retreat_messages_allowed,
        public bool $message_mode_non_playing_messages_allowed,
        public bool $message_mode_pre_game_messages_allowed,
        public bool $message_mode_post_game_messages_allowed,
    ) {
    }

    public static function fromRequest(FormRequest $request): CreateGameTransfer
    {
        return new CreateGameTransfer(
            variant_id: $request->get('variant_id'),
            scs_to_win: $request->get('scs_to_win'),
            phase_length: $request->get('phase_length'),
            join_phase_length: $request->get('join_phase_length'),
            end_forming_phase_when_enough_players: $request->get('end_forming_phase_when_enough_players'),
            allow_power_selection: $request->get('allow_power_selection'),
            display_power_names: $request->get('display_power_names'),
            has_manual_orders: $request->get('has_manual_orders'),
            message_mode_name: $request->get('message_mode_name'),
            message_mode_description: $request->get('message_mode_description'),
            message_mode_template_id: $request->get('message_mode_template_id'),
            message_mode_room_creation_allowed: $request->get('message_mode_room_creation_allowed'),
            message_mode_signing_allowed: $request->get('message_mode_signing_allowed'),
            message_mode_adjustment_messages_allowed: $request->get('message_mode_adjustment_messages_allowed'),
            message_mode_move_messages_allowed: $request->get('message_mode_move_messages_allowed'),
            message_mode_retreat_messages_allowed: $request->get('message_mode_retreat_messages_allowed'),
            message_mode_non_playing_messages_allowed: $request->get('message_mode_non_playing_messages_allowed'),
            message_mode_pre_game_messages_allowed: $request->get('message_mode_pre_game_messages_allowed'),
            message_mode_post_game_messages_allowed: $request->get('message_mode_post_game_messages_allowed')

        );
    }
}