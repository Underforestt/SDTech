<?php

namespace SDTech\Middleware;

class LocalityPopulationCheckMiddleware extends Middleware
{
    public function check(array $properties): bool
    {
        if (strlen($properties['population']) < 100) {
            echo "LocalityNameCheckMiddleware: Population is too low, sorry(\n";

            return false;
        }
        echo "LocalityPopulationCheckMiddleware: passed\n";
        return parent::check($properties);
    }
}