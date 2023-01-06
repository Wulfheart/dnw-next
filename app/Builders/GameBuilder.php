<?php

namespace App\Builders;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class GameBuilder extends Builder
{
    public function whereActive(): static
    {
        $this->whereDoesntHave('powers', fn (Builder $query) => $query->whereNull('user_id'))
            ->whereDoesntHave('powers', fn (Builder $query) => $query->where('is_winner', true));

        return $this;
    }

    public function whereUserIsMember(User $user): static
    {
        $this->whereHas('powers', fn (Builder $query) => $query->where('user_id', $user->id));

        return $this;
    }

    public function whereNew(): static
    {
        $this->whereHas('powers', fn (Builder $query) => $query->whereNull('user_id'))
            ->has('phases', '=', 1);

        return $this;
    }

    public function whereFinished(): static
    {
        $this->whereHas('powers', fn (Builder $query) => $query->where('is_winner', true));

        return $this;
    }

    public function loadForIndexPages(): static
    {
        $this->with([
            'currentPhase.phasePowerData.power.basePower',
            'powers',
            'variant.basePowers',
            'winners',
        ]);

        return $this;
    }

    public function whereCanBeAjdudicated(): static
    {
        $this->with('currentPhase')->whereHas('currentPhase', function (Builder $builder) {
            $builder->whereNull('locked_for_adjudication_at')->where('adjudication_at', '<=', now());
        });

        return $this;
    }

    public function whereNotAdjudicating(): static
    {
        $this->with('currentPhase')->whereHas('currentPhase', function (Builder $builder) {
            $builder->whereNull('locked_for_adjudication_at');
        });

        return $this;
    }
}
