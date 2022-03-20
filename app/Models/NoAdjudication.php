<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperNoAdjudication
 */
class NoAdjudication extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'game_id' => 'integer',
        'iso_weekday' => 'integer',
    ];


    public function game()
    {
        return $this->belongsTo(\App\Models\Game::class);
    }
}
