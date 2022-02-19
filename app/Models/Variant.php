<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperVariant
 */
class Variant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'api_name',
        'name',
        'default_scs_to_win',
        'total_scs',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
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
