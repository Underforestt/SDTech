<?php

namespace SDTech\Middleware;

class LocalityNameCheckMiddleware extends Middleware
{
    public function check(array $properties): bool
    {
        if (strlen($properties['name']) > 20) {
            echo "LocalityNameCheckMiddleware: This name is too long\n";

            return false;
        }
        echo "LocalityNameCheckMiddleware: passed\n";
        return parent::check($properties);
    }
}