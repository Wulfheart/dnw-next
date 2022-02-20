<?php

use Carbon\CarbonInterval;

if(!function_exists('storage_asset')){
    function storage_asset(string $s): string {
        return asset('storage/' . $s);
    }
}
if(!function_exists('humanize_minutes')){
    function humanize_minutes(int $m): string {
        return CarbonInterval::minutes($m)->cascade()->forHumans(['short' => true]);
    }
}