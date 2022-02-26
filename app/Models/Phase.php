<?php

namespace App\Models;

use App\Enums\PhaseTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperPhase
 */
class Phase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'number',
        'previous_phase_id',
        'game_id',
        'svg_adjudicated',
        'svg_with_orders',
        'state_encoded',
        'phase_name_long',
        'phase_name_short',
        'adjudication_at',
        'adjudicated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'previous_phase_id' => 'integer',
        'game_id' => 'integer',
        'adjudication_at' => 'datetime',
        'type' => PhaseTypeEnum::class,
    ];


    public function previousPhase(): BelongsTo
    {
        return $this->belongsTo(Phase::class);
    }

    public function phasePowerData(): HasMany
    {
        return $this->hasMany(PhasePowerData::class)->orderBy('supply_center_count', 'DESC')->orderBy('unit_count', 'DESC');
    }
    // public function
}
