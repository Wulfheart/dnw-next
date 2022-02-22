<?php

namespace App\Models;

use App\Builders\GameBuilder;
use App\Enums\GameStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperGame
 */
class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'variant_id',
        'phase_length',
        'is_paused',
        'scs_to_win',
        'join_phase_length',
        'start_when_ready'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
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


    public function variant(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Variant::class);
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

    public function phases(): HasMany {
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

    public function currentState(): GameStatusEnum{
        $this->loadMissing(['winners', 'powers']);
        if($this->winners->count() > 0){
            return GameStatusEnum::FINISHED;
        }

        if($this->powers->whereNotNull('user_id')->count() < $this->powers->count()){
            return GameStatusEnum::PREGAME;
        }

        return GameStatusEnum::RUNNING;
    }
}
