<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BasePower
 *
 * @property int $id
 * @property string $color
 * @property string $name
 * @property string $api_name
 * @property int $variant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Variant $variant
 * @method static \Database\Factories\BasePowerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower query()
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower whereApiName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower whereVariantId($value)
 */
	class IdeHelperBasePower {}
}

namespace App\Models{
/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $name
 * @property int $variant_id
 * @property int $message_mode_id
 * @property int $phase_length
 * @property bool $is_paused
 * @property int|null $scs_to_win
 * @property int|null $join_phase_length
 * @property bool|null $start_when_ready
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Phase|null $currentPhase
 * @property-read \App\Models\MessageMode|null $messageMode
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\NoAdjudication[] $noAdjudicationDays
 * @property-read int|null $no_adjudication_days_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PhasePowerData[] $phasePowerData
 * @property-read int|null $phase_power_data_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Phase[] $phases
 * @property-read int|null $phases_count
 * @property-read \App\Collections\PowerCollection|\App\Models\Power[] $powers
 * @property-read int|null $powers_count
 * @property-read \App\Models\Variant $variant
 * @property-read \App\Collections\PowerCollection|\App\Models\Power[] $winners
 * @property-read int|null $winners_count
 * @method static \App\Collections\GameCollection|static[] all($columns = ['*'])
 * @method static \Database\Factories\GameFactory factory(...$parameters)
 * @method static \App\Collections\GameCollection|static[] get($columns = ['*'])
 * @method static \App\Builders\GameBuilder|Game loadForIndexPages()
 * @method static \App\Builders\GameBuilder|Game newModelQuery()
 * @method static \App\Builders\GameBuilder|Game newQuery()
 * @method static \App\Builders\GameBuilder|Game query()
 * @method static \App\Builders\GameBuilder|Game whereActive()
 * @method static \App\Builders\GameBuilder|Game whereCanBeAjdudicated()
 * @method static \App\Builders\GameBuilder|Game whereCreatedAt($value)
 * @method static \App\Builders\GameBuilder|Game whereFinished()
 * @method static \App\Builders\GameBuilder|Game whereId($value)
 * @method static \App\Builders\GameBuilder|Game whereIsPaused($value)
 * @method static \App\Builders\GameBuilder|Game whereJoinPhaseLength($value)
 * @method static \App\Builders\GameBuilder|Game whereMessageModeId($value)
 * @method static \App\Builders\GameBuilder|Game whereName($value)
 * @method static \App\Builders\GameBuilder|Game whereNew()
 * @method static \App\Builders\GameBuilder|Game wherePhaseLength($value)
 * @method static \App\Builders\GameBuilder|Game whereScsToWin($value)
 * @method static \App\Builders\GameBuilder|Game whereStartWhenReady($value)
 * @method static \App\Builders\GameBuilder|Game whereUpdatedAt($value)
 * @method static \App\Builders\GameBuilder|Game whereUserIsMember(\App\Models\User $user)
 * @method static \App\Builders\GameBuilder|Game whereVariantId($value)
 */
	class IdeHelperGame {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property int $sender_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Power $sender
 * @method static \Database\Factories\MessageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 */
	class IdeHelperMessage {}
}

namespace App\Models{
/**
 * App\Models\MessageMode
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property bool $room_creation_allowed
 * @property bool $signing_allowed
 * @property bool $adjustment_messages_allowed
 * @property bool $move_messages_allowed
 * @property bool $retreat_messages_allowed
 * @property bool $non_playing_messages_allowed
 * @property bool $pre_game_messages_allowed
 * @property bool $post_game_messages_allowed
 * @property bool $show_player_identities_during_game
 * @property bool $is_custom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode query()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereAdjustmentMessagesAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereIsCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereMoveMessagesAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereNonPlayingMessagesAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode wherePostGameMessagesAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode wherePreGameMessagesAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereRetreatMessagesAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereRoomCreationAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereShowPlayerIdentitiesDuringGame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereSigningAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageMode whereUpdatedAt($value)
 */
	class IdeHelperMessageMode {}
}

namespace App\Models{
/**
 * App\Models\MessageRoom
 *
 * @property int $id
 * @property string $name
 * @property bool $is_group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MessageRoomMembership[] $memberships
 * @property-read int|null $memberships_count
 * @property-read \App\Collections\PowerCollection|\App\Models\Power[] $powers
 * @property-read int|null $powers_count
 * @method static \Database\Factories\MessageRoomFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom query()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom whereIsGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom whereUpdatedAt($value)
 */
	class IdeHelperMessageRoom {}
}

namespace App\Models{
/**
 * App\Models\MessageRoomMembership
 *
 * @property int $id
 * @property int $power_id
 * @property int $message_room_id
 * @property \Illuminate\Support\Carbon $joined_at
 * @property \Illuminate\Support\Carbon $last_visited_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MessageRoom $messageRoom
 * @property-read \App\Models\Power $power
 * @method static \Database\Factories\MessageRoomMembershipFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership query()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership whereJoinedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership whereLastVisitedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership whereMessageRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership wherePowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership whereUpdatedAt($value)
 */
	class IdeHelperMessageRoomMembership {}
}

namespace App\Models{
/**
 * App\Models\Model
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Model newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Model newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Model query()
 */
	class IdeHelperModel {}
}

namespace App\Models{
/**
 * App\Models\NoAdjudication
 *
 * @property int $id
 * @property int $game_id
 * @property int $iso_weekday
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Game $game
 * @method static \Database\Factories\NoAdjudicationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication query()
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication whereIsoWeekday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication whereUpdatedAt($value)
 */
	class IdeHelperNoAdjudication {}
}

namespace App\Models{
/**
 * App\Models\Phase
 *
 * @property int $id
 * @property \App\Enums\PhaseTypeEnum $type
 * @property int $number
 * @property int $game_id
 * @property string $svg_adjudicated
 * @property string|null $svg_with_orders
 * @property string $state_encoded
 * @property string $phase_name_long
 * @property string $phase_name_short
 * @property \Illuminate\Support\Carbon|null $locked_for_adjudication_at
 * @property \Illuminate\Support\Carbon|null $adjudication_at
 * @property \Illuminate\Support\Carbon|null $adjudicated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PhasePowerData[] $phasePowerData
 * @property-read int|null $phase_power_data_count
 * @property-read Phase|null $previousPhase
 * @method static \Database\Factories\PhaseFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase query()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereAdjudicatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereAdjudicationAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereLockedForAdjudicationAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase wherePhaseNameLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase wherePhaseNameShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereStateEncoded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereSvgAdjudicated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereSvgWithOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereUpdatedAt($value)
 */
	class IdeHelperPhase {}
}

namespace App\Models{
/**
 * App\Models\PhasePowerData
 *
 * @property int $id
 * @property int $phase_id
 * @property int $power_id
 * @property int $home_center_count
 * @property int $supply_center_count
 * @property int $unit_count
 * @property bool $orders_needed
 * @property bool $ready_for_adjudication
 * @property string|null $orders
 * @property string|null $applied_orders
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Phase $phase
 * @property-read \App\Models\Power $power
 * @method static \Database\Factories\PhasePowerDataFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData whereAppliedOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData whereHomeCenterCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData whereOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData whereOrdersNeeded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData wherePhaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData wherePowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData whereReadyForAdjudication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData whereSupplyCenterCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData whereUnitCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData whereUpdatedAt($value)
 */
	class IdeHelperPhasePowerData {}
}

namespace App\Models{
/**
 * App\Models\Power
 *
 * @property int $id
 * @property int $base_power_id
 * @property int|null $user_id
 * @property int $game_id
 * @property bool $is_defeated
 * @property bool $is_winner
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BasePower $basePower
 * @property-read \App\Models\Game $game
 * @property-read \App\Models\User|null $user
 * @method static \App\Collections\PowerCollection|static[] all($columns = ['*'])
 * @method static \Database\Factories\PowerFactory factory(...$parameters)
 * @method static \App\Collections\PowerCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Power newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Power newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Power query()
 * @method static \Illuminate\Database\Eloquent\Builder|Power whereBasePowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Power whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Power whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Power whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Power whereIsDefeated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Power whereIsWinner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Power whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Power whereUserId($value)
 */
	class IdeHelperPower {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property bool $is_admin
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * App\Models\Variant
 *
 * @property int $id
 * @property string $api_name
 * @property string $name
 * @property int $default_scs_to_win
 * @property int $total_scs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BasePower[] $basePowers
 * @property-read int|null $base_powers_count
 * @method static \Database\Factories\VariantFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereApiName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereDefaultScsToWin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereTotalScs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereUpdatedAt($value)
 */
	class IdeHelperVariant {}
}

