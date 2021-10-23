<?php

namespace App\Builders;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class GameBuilder extends Builder
{
    public function whereActive(): static
    {
        $this->whereDoesntHave('powers', fn(Builder $query) => $query->whereNull('user_id'))
            ->whereDoesntHave('powers', fn(Builder $query) => $query->where('is_winner', true))
            ;
        return $this;
    }

    public function whereUserIsMember(User $user): static
    {
        $this->whereHas('powers', fn(Builder $query) => $query->where('user_id', $user->id));
        return $this;
    }

    public function whereNew(): static
    {
        $this->whereHas('powers', fn(Builder $query) => $query->whereNull('user_id'))
        ->has('phases', '>=', 1);
        return $this;
    }

    public function whereFinished(): static
    {
        $this->whereHas('powers', fn(Builder $query) => $query->where('is_winner', true));
        return $this;
    }
}