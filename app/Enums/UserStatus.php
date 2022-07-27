<?php

namespace App\Enums;

enum UserStatus: string
{
    use EnumTrait;

    case PENDING = 'pending';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
