<?php

namespace App\DTOs;

interface BaseDTO
{
    /**
     * Convert this object to array
     *
     * @return array
     */
    public function toArray(): array;
}
