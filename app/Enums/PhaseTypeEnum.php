<?php

namespace App\Enums;

enum PhaseTypeEnum: string
{
    case MOVEMENT = 'M';
    case ADJUSTMENT = 'A';
    case RETREAT = 'R';
    case NON_PLAYING = '-';
}
