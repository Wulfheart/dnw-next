<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


    public function variant()
    {
        return $this->belongsTo(\App\Models\Variant::class);
    }

    public function noAdjudicationDays(){
        return $this->hasMany(NoAdjudication::class);
    }

    public function powers(){
        return $this->hasMany(Power::class);
    }

    public function currentPhase(){
        return $this->hasOne(Phase::class)->latestOfMany();
    }
}
