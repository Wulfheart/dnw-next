<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperBasePower
 */
class BasePower extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'variant_id' => 'integer',
    ];


    public function variant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Variant::class);
    }
}
