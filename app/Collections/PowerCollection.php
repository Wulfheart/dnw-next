<?php

namespace App\Collections;

class PowerCollection extends \Illuminate\Database\Eloquent\Collection
{
    public function whereUserAssigned(): self {
        return $this->whereNotNull('user_id');
    }

}