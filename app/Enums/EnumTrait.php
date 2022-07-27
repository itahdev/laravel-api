<?php

namespace App\Enums;

use Illuminate\Support\Collection;

trait EnumTrait
{
    /**
     * @return Collection
     */
    public static function collections(): Collection
    {
        return Collection::make(self::cases());
    }

    /**
     * @return array
     */
    public static function values(): array
    {
        return self::collections()->pluck('value')->toArray();
    }

    /**
     * @return array
     */
    public static function keys(): array
    {
        return self::collections()->pluck('keys')->toArray();
    }

    /**
     * @param string $enum
     * @return bool
     */
    public static function in(string $enum): bool
    {
        return self::collections()->contains('value', $enum);
    }

    /**
     * @param string $enum
     * @return bool
     */
    public function is(string $enum): bool
    {
        return $this->value === $enum;
    }
}
