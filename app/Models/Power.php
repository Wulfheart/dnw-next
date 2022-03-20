<?php

namespace App\Models;

use App\Collections\PowerCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperPower
 */
class Power extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'base_power_id' => 'integer',
        'user_id' => 'integer',
        'game_id' => 'integer',
        'is_defeated' => 'boolean',
        'is_winner' => 'boolean',
    ];

    public function newCollection(array $models = []): PowerCollection
    {
        return new PowerCollection($models);
    }


    public function basePower()
    {
        return $this->belongsTo(\App\Models\BasePower::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
