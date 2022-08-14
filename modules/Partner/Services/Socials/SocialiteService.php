<?php

namespace Modules\Partner\Services\Socials;

use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\AbstractProvider;

class SocialiteService extends SocialiteManager
{
    /**
     * @return AbstractProvider
     */
    public function createLineDriver(): AbstractProvider
    {
        $config = $this->config->get('services.line');

        return $this->buildProvider(Line::class, $config);
    }

    /**
     * @return AbstractProvider
     */
    public function createYahooDriver(): AbstractProvider
    {
        $config = $this->config->get('services.yahoo');

        return $this->buildProvider(Yahoo::class, $config);
    }


}
