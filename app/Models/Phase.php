<?php

namespace App\Models;

use App\Enums\PhaseTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperPhase
 */
class Phase extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'previous_phase_id' => 'integer',
        'game_id' => 'integer',
        'locked_for_adjudication_at' => 'datetime',
        'adjudication_at' => 'datetime',
        'adjudicated_at' => 'datetime',
        'type' => PhaseTypeEnum::class,
    ];

    public function previousPhase(): BelongsTo
    {
        return $this->belongsTo(Phase::class);
    }

    public function phasePowerData(): HasMany
    {
        return $this->hasMany(PhasePowerData::class)->orderBy('supply_center_count', 'DESC')
            ->orderBy('unit_count', 'DESC');
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function adjudicationStarted(): bool
    {
        return ! is_null($this->locked_for_adjudication_at);
    }

    public function lockForAdjudication(): void
    {
        $this->locked_for_adjudication_at = now();
        $this->save();
    }

    public function statusType(): Attribute
    {
        return Attribute::get(function () {
        });
    }
}
