<?php

namespace App\Enums;

enum PhaseStatusEnum
{
    case RUNNING;
    case ADJUDICATING;
    case ADJUDICATED;
}