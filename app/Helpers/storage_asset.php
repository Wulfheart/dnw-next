<?php

if(!function_exists('storage_asset')){
    function storage_asset(string $s): string {
        return asset('storage/' . $s);
    }
}