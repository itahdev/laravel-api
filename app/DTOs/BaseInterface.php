<?php

namespace App\DTOs;

interface BaseInterface
{
    /**
     * Convert this object to array
     *
     * @return array
     */
    public function toArray(): array;
}
