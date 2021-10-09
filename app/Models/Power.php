<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Power extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'base_power_id',
        'user_id',
        'game_id',
        'is_defeated',
        'is_winner',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'base_power_id' => 'integer',
        'user_id' => 'integer',
        'game_id' => 'integer',
        'is_defeated' => 'boolean',
        'is_winner' => 'boolean',
    ];


    public function basePower()
    {
        return $this->belongsTo(\App\Models\BasePower::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function game(){
        return $this->belongsTo(Game::class);
    }
}
