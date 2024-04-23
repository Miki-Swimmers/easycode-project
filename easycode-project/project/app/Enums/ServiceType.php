<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ServiceType
{
    use EnumToArray;

    case telegram;

    case mail;

    case sms;
}
