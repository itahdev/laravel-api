<?php

namespace Modules\Partner\DTOs;

use App\DTOs\BaseInterface;

class AuthResponse implements BaseInterface
{
    /** @var string */
    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'token' => $this->token,
        ];
    }
}
