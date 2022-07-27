<?php

namespace Modules\Partner\Repositories\Parameters;

class AuthLoginParam
{
    /** @var string */
    public string $email;

    /** @var string */
    public string $password;

    /**
     * AuthLoginParam constructor.
     *
     * @param string $email
     * @param string $password
     */
    public function __construct(
        string $email,
        string $password,
    ) {
        $this->email = $email;
        $this->password = $password;
    }
}
