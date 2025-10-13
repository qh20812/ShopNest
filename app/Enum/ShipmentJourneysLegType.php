<?php

namespace App\Enums;

enum ShipmentJourneysLegType: string
{
    case FIRST_MILE = 'first_mile';
    case MIDDLE_MILE = 'middle_mile';
    case LAST_MILE = 'last_mile';
}