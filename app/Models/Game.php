<?php

namespace App\Models;

use App\Builders\GameBuilder;
use App\Collections\GameCollection;
use App\Enums\GameStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @mixin IdeHelperGame
 */
class Game extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'variant_id' => 'integer',
        'phase_length' => 'integer',
        'is_paused' => 'boolean',
        'scs_to_win' => 'integer',
        'join_phase_length' => 'integer',
        'start_when_ready' => 'boolean',
    ];

    public function newEloquentBuilder($query): GameBuilder
    {
        return new GameBuilder($query);
    }

    public function newCollection(array $models = [])
    {
        return new GameCollection($models);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Variant::class);
    }

    public function messageMode(): BelongsTo
    {
        return $this->belongsTo(MessageMode::class);
    }

    public function noAdjudicationDays(): HasMany
    {
        return $this->hasMany(NoAdjudication::class);
    }

    public function powers(): HasMany
    {
        return $this->hasMany(Power::class);
    }

    public function currentPhase(): HasOne
    {
        return $this->hasOne(Phase::class)->ofMany('number', 'max');
    }

    public function phases(): HasMany
    {
        return $this->hasMany(Phase::class)->orderByDesc('number');
    }

    public function winners(): HasMany
    {
        return $this->hasMany(Power::class)->where('is_winner');
    }

    public function phasePowerData(): HasManyThrough
    {
        return $this->hasManyThrough(PhasePowerData::class, Phase::class);
    }

    public function currentState(): GameStatusEnum
    {
        $this->loadMissing(['winners', 'powers']);
        if ($this->winners->count() > 0) {
            return GameStatusEnum::FINISHED;
        }

        if ($this->powers->whereUserAssigned()->count() < $this->powers->count()) {
            return GameStatusEnum::PREGAME;
        }

        return GameStatusEnum::RUNNING;
    }

    public function hasStarted(): bool
    {
        return $this->currentState() === GameStatusEnum::RUNNING;
    }

    public function calculateNextAdjudicationPhaseEnd(): Carbon
    {
        $this->loadMissing('noAdjudicationDays');

        $adjudicationTime = now()->clone()->addMinutes($this->phase_length);

        $no_adjudication_days = $this->noAdjudicationDays->pluck('iso_weekday');
        while ($no_adjudication_days->contains($adjudicationTime->isoWeekday())) {
            $adjudicationTime->addDay();
        }

        return $adjudicationTime;
    }

    public function hasUnreadMessagesForUserId(int $user_id): bool
    {
        // This may be solved a little bit more elegant but it is sufficient for now
        $this->loadMissing(['powers']);
        $power = Power::with('messageRooms')->where('user_id', $user_id)->where('game_id', $this->id)->first();
        if ($power === null) {
            return false;
        }
        foreach ($power->messageRooms as $messageRoom) {
            if ($messageRoom->getUnreadForPower($power->id)) {
                return true;
            }
        }

        return false;
    }
}
