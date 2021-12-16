<?php
require "config.php";
require __DIR__."/vendor/autoload.php";
use SDTech\DAL\Repositories\Impl\DiseaseRepository;
use SDTech\DAL\Repositories\Impl\LocalityRepository;
use SDTech\DAL\Repositories\Impl\Retry;
use SDTech\Middleware\LocalityNameCheckMiddleware;
use SDTech\Middleware\LocalityPopulationCheckMiddleware;
use SDTech\Observers\Disease\OnboardNotification;
use SDTech\Patterns\Database;








