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
 * @property-read \App\Models\Variant|null $variant
 * @method static \Database\Factories\BasePowerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasePower query()
 */
	class IdeHelperBasePower {}
}

namespace App\Models{
/**
 * App\Models\Game
 *
 * @property-read \App\Models\Phase|null $currentPhase
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\NoAdjudication[] $noAdjudicationDays
 * @property-read int|null $no_adjudication_days_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PhasePowerData[] $phasePowerData
 * @property-read int|null $phase_power_data_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Phase[] $phases
 * @property-read int|null $phases_count
 * @property-read \App\Collections\PowerCollection|\App\Models\Power[] $powers
 * @property-read int|null $powers_count
 * @property-read \App\Models\Variant|null $variant
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
 * @method static \App\Builders\GameBuilder|Game whereFinished()
 * @method static \App\Builders\GameBuilder|Game whereNew()
 * @method static \App\Builders\GameBuilder|Game whereUserIsMember(\App\Models\User $user)
 */
	class IdeHelperGame {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property-read \App\Models\Power|null $sender
 * @method static \Database\Factories\MessageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 */
	class IdeHelperMessage {}
}

namespace App\Models{
/**
 * App\Models\MessageRoom
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MessageRoomMembership[] $memberships
 * @property-read int|null $memberships_count
 * @property-read \App\Collections\PowerCollection|\App\Models\Power[] $powers
 * @property-read int|null $powers_count
 * @method static \Database\Factories\MessageRoomFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoom query()
 */
	class IdeHelperMessageRoom {}
}

namespace App\Models{
/**
 * App\Models\MessageRoomMembership
 *
 * @property-read \App\Models\MessageRoom|null $messageRoom
 * @property-read \App\Models\Power|null $power
 * @method static \Database\Factories\MessageRoomMembershipFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageRoomMembership query()
 */
	class IdeHelperMessageRoomMembership {}
}

namespace App\Models{
/**
 * App\Models\NoAdjudication
 *
 * @property-read \App\Models\Game|null $game
 * @method static \Database\Factories\NoAdjudicationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoAdjudication query()
 */
	class IdeHelperNoAdjudication {}
}

namespace App\Models{
/**
 * App\Models\Phase
 *
 * @property \App\Enums\PhaseTypeEnum $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PhasePowerData[] $phasePowerData
 * @property-read int|null $phase_power_data_count
 * @property-read Phase|null $previousPhase
 * @method static \Database\Factories\PhaseFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase query()
 */
	class IdeHelperPhase {}
}

namespace App\Models{
/**
 * App\Models\PhasePowerData
 *
 * @property-read \App\Models\Phase|null $phase
 * @property-read \App\Models\Power|null $power
 * @method static \Database\Factories\PhasePowerDataFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhasePowerData query()
 */
	class IdeHelperPhasePowerData {}
}

namespace App\Models{
/**
 * App\Models\Power
 *
 * @property-read \App\Models\BasePower|null $basePower
 * @property-read \App\Models\Game|null $game
 * @property-read \App\Models\User|null $user
 * @method static \App\Collections\PowerCollection|static[] all($columns = ['*'])
 * @method static \Database\Factories\PowerFactory factory(...$parameters)
 * @method static \App\Collections\PowerCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Power newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Power newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Power query()
 */
	class IdeHelperPower {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * App\Models\Variant
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BasePower[] $basePowers
 * @property-read int|null $base_powers_count
 * @method static \Database\Factories\VariantFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant query()
 */
	class IdeHelperVariant {}
}

