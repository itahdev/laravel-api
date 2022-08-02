<?php

namespace Modules\Admin\Repositories\Parameters;

class AuthLoginParam
{
    /** @var string */
    public string $email;

    /** @var string */
    public string $password;

    /** @var string */
    public string $device_name;

    /**
     * AuthLoginParam constructor.
     *
     * @param string $email
     * @param string $password
     * @param string $device_name
     */
    public function __construct(string $email, string $password, string $device_name) {
        $this->email = $email;
        $this->password = $password;
        $this->device_name = $device_name;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'device_name' => $this->device_name,
        ];
    }
}
