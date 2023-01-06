<?php

namespace App\Collections;

class PowerCollection extends \Illuminate\Database\Eloquent\Collection
{
    public function whereUserAssigned(): self
    {
        return $this->whereNotNull('user_id');
    }

    public function whereUserNotAssigned(): self
    {
        return $this->whereNull('user_id');
    }
}
