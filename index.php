<?php
require "config.php";
require "vendor/autoload.php";
require "Database.php";

use DB\Database;
use SDTech\DAL\Repositories\Impl\DiseaseRepository;
use SDTech\DAL\Repositories\Impl\LocalityRepository;
$db = new Database();

//$properties = ['name' => 'Covid', 'caseAmount' => 19];
//DiseaseRepository::create($properties);
//$diseases = DiseaseRepository::getAll();
//$propertiesLocality = ['name' => 'Yablunivka', 'population' => 228, 'diseases' => $diseases];
//LocalityRepository::create($propertiesLocality);
//
//$loc = LocalityRepository::get(1);
//print_r($loc->diseases()->get()->toArray());





