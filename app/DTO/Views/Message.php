<?php

namespace App\DTO\Views;

use Illuminate\Support\Carbon;

class Message
{
    public string $sentAt;

    public function __construct(
        public int $id,
        public string $name,
        public string $color,
        public string $text,
        public bool $fromUser,
        Carbon $sentAt,
    ){
        $this->sentAt = $this->formatSendAt($sentAt);
    }

    protected function formatSendAt(Carbon $date) {
        return match(true) {
            $date->isCurrentDay() => $date->isoFormat("HH:mm"),
            $date->isYesterday() => $date->isoFormat("[Gestern] HH:mm"),
            $date->greaterThan(now()->startOfDay()->addDay()->subWeek()) => $date->isoFormat("dddd HH:mm"),
            default => $date->isoFormat("DD.MM.YY HH:mm")

        };
    }
}