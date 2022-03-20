<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperVariant
 */
class Variant extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'default_scs_to_win' => 'integer',
        'total_scs' => 'integer',
    ];

    public function basePowers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BasePower::class);
    }
}
