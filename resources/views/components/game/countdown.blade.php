@props(['isoDatetime'])

<span x-countdown x-countdown-end="{{ $isoDatetime }}">{{ remainingTimeText($isoDatetime) }}</span>
