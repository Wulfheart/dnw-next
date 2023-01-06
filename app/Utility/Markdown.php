<?php

namespace App\Utility;

use Parsedown;

class Markdown
{
    public static function toHtml(string $text): string
    {
        $renderer = new Parsedown();
        $renderer->setSafeMode(true);

        return $renderer->line($text);
    }
}
