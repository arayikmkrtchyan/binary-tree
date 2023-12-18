<?php

namespace Calculation;

trait CountTrait
{
    private int $count = 0;

    public function getCount(): int
    {
        return $this->count;
    }
}