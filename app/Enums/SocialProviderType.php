<?php

namespace App\Enums;

enum SocialProviderType: string
{
    use EnumTrait;

    case FACEBOOK = 'facebook';
    case LINE = 'line';
    case TWITTER = 'twitter';
    case YAHOO = 'yahoo';
    case GOOGLE = 'google';
}
