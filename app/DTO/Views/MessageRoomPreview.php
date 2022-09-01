<?php

namespace App\DTO\Views;


use App\Utility\Markdown;
use Illuminate\Support\Carbon;

class MessageRoomPreview
{

    public ?string $previewSentAt;

    public function __construct(
        public int $id,
        public string $name,
        public string $textColor,
        public ?string $previewText,
        public ?string $previewPowerName,
        public bool $unread,
        ?Carbon $previewSentAt,
    ){
        $this->previewSentAt = $this->formatPreviewSentAt($previewSentAt);
        if($this->previewText != null) {
            $this->previewText = Markdown::toHtml($this->previewText);
        }
    }

    protected function formatPreviewSentAt(?Carbon $date): ?string {
        if($date === null) {
            return null;
        }

        return match(true) {
            $date->isCurrentDay() => $date->isoFormat("HH:mm"),
            $date->isYesterday() => $date->isoFormat("[Gestern]"),
            $date->greaterThan(now()->startOfDay()->addDay()->subWeek()) => $date->isoFormat("dddd"),
            default => $date->isoFormat("DD.MM.YY")

        };
    }
}