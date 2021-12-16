<?php


namespace SDTech\BLL\DTO\Services\Impl;
require 'C:\Users\user\Desktop\3курс\1семестр\Розробка ПО\SDtech\BLL\DTO\Services\Interfaces\DiseaseServiceInterface.php';
require 'C:\Users\user\Desktop\3курс\1семестр\Розробка ПО\SDtech\Patterns\Singleton.php';
require 'C:\Users\user\Desktop\3курс\1семестр\Розробка ПО\SDtech\vendor\autoload.php';
use Exception;
use SDTech\BLL\DTO\DiseaseDTO;
use SDTech\BLL\DTO\Interfaces\DiseaseServiceInterface;
use SDTech\CCL\SecurityContext;
use SDTech\DAL\Repositories\Impl\LocalityRepository;
use SDTech\DB\Singleton;

class DiseaseService implements DiseaseServiceInterface, Singleton
{
    public static ?DiseaseService $instance = null;

    protected function __construct(){}
    protected function __clone(){}

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getDiseases()
    {
        $user = SecurityContext::getUser();
        if (!$user->isEmailVerified()){
            throw new Exception("Access for method denied");
        }

        $locality = LocalityRepository::get($user->localityId);
        $diseases = $locality->diseases()->get()->toArray();

        $diseasesDto = [];
        foreach ($diseases as $disease){
            $diseasesDto[] = new DiseaseDTO(
                $disease['id'],
                $disease['name'],
                $disease['caseAmount']
            );
        }
        return $diseasesDto;
    }
}

function clientCode()
{
    $s1 = DiseaseService::getInstance();
    $s2 = DiseaseService::getInstance();
    if ($s1 === $s2) {
        echo "Singleton works, both variables contain the same instance.";
    } else {
        echo "Singleton failed, variables contain different instances.";
    }
}

clientCode();