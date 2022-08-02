<?php

namespace App\Enums;

use App\Models\Admin;
use App\Models\ClientUser;

enum Guard: string
{
    use EnumTrait;

    case CLIENT = 'client';
    case ADMIN = 'admin';
    case USER = 'user';

    /**
     * @param Guard $value
     * @return string
     */
    public static function provider(self $value): string
    {
        return match ($value) {
            self::CLIENT => 'clients',
            self::ADMIN => 'admins',
            self::USER => 'users',
        };
    }

    /**
     * @param Guard $value
     * @return string
     */
    public static function model(self $value): string
    {
        return match ($value) {
            self::CLIENT => ClientUser::class,
            self::ADMIN => Admin::class,
            self::USER => 'users',
        };
    }
}
