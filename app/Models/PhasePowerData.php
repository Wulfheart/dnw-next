<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperPhasePowerData
 */
class PhasePowerData extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phase_id',
        'power_id',
        'home_center_count',
        'supply_center_count',
        'unit_count',
        'orders_needed',
        'orders',
        'applied_orders',
        'ready_for_adjudication',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'phase_id' => 'integer',
        'power_id' => 'integer',
        'home_center_count' => 'integer',
        'supply_center_count' => 'integer',
        'unit_count' => 'integer',
        'orders_needed' => 'boolean',
        'ready_for_adjudication' => 'boolean',
    ];


    public function phase(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Phase::class);
    }

    public function power(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Power::class);
    }
}
