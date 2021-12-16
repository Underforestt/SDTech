<?php

namespace SDTech\Middleware;

abstract class Middleware
{
    /**
     * @var Middleware
     */
    private $next;

    public function linkWith(Middleware $next): Middleware
    {
        $this->next = $next;

        return $next;
    }

    public function check(array $properties): bool
    {
        if (!$this->next) {
            return true;
        }

        return $this->next->check($properties);
    }
}
