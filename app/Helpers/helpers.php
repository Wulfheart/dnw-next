<?php

use Carbon\CarbonInterval;

if (!function_exists('storage_asset')) {
    function storage_asset(string $s): string
    {
        return asset('storage/'.$s);
    }
}
if (!function_exists('humanize_minutes')) {
    function humanize_minutes(int $m): string
    {
        return CarbonInterval::minutes($m)->cascade()->forHumans(['short' => true]);
    }
}
if (!function_exists('remainingTimeText')) {
    function remainingTimeText(string $isoDatetime): string
    {
        $secondsRemaining = \Illuminate\Support\Facades\Date::now()->diffInSeconds($isoDatetime);
        if (now()->lessThanOrEqualTo($isoDatetime)) {
            $secondsRemaining *= -1;
        }
        if ($secondsRemaining <= 0) {
            return "Jetzt";
        }

        $seconds = floor($secondsRemaining % 60);
        $minutes = floor(($secondsRemaining % (60 * 60)) / 60);
        $hours = floor($secondsRemaining % (24 * 60 * 60) / (60 * 60));
        $day = floor($secondsRemaining / (24 * 60 * 60));

        if ($day > 0) // D, H
        {
            $minutes += round($seconds / 60); // Add a minute if the $second almost give a minute
            $hours += round($minutes / 60); // Add an hour if the $minutes almost gives an hour

            if ($day < 2) {
                // setMinimumTimerInterval(60 * $minutes);
                return "1d ".$hours."h";
            } else {
                // setMinimumTimerInterval(60 * 60 * $hours);
                return $day."d";
            }
        } else {
            if ($hours > 0) // H, M
            {
                $minutes += round($seconds / 60); // Add a minute if the $second almost give a minute)

                if ($hours < 4) {
                    // setMinimumTimerInterval($second);
                    return $hours."h ".$minutes."m";
                } else {
                    // setMinimumTimerInterval($minutes * 60);

                    $hours += round($minutes / 60); // Add an hour if the $minutes almost gives an hour

                    return $hours."h";
                }
            } else // M, S
            {
                if ($minutes >= 5) {
                    // setMinimumTimerInterval($second);
                    return $minutes." m";
                } else {
                    // setMinimumTimerInterval(1);

                    if ($minutes > 0) {
                        return $minutes."m ".$seconds."s";
                    } else {
                        return $seconds."s";
                    }
                }
            }
        }
    }
}
