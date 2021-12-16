<?php

namespace SDTech\BLL\DTO\Tests;

use Illuminate\Database\Capsule\Manager as DB;
use SDTech\BLL\DTO\Services\Impl\DiseaseService;
use SDTech\CCL\Identity\User;
use SDTech\CCL\SecurityContext;
use SDTech\DAL\Entities\Disease;
use SDTech\DAL\Entities\Locality;
use SDTech\DAL\Repositories\Impl\DiseaseRepository;

require 'CCL/Identity/User.php';
require 'CCL/SecurityContext.php';
require 'BLL/DTO/Services/Impl/DiseaseService.php';
require 'DAL/Repositories/Impl/DiseaseRepository.php';

class DiseaseServiceTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->configureDatabase();
        $this->migrateDiseaseTable();
        $this->migrateLocalityTable();
    }
    protected function configureDatabase()
    {
        $db = new DB;
        $db->addConnection(array(
            'driver'    => 'sqlite',
            'database'  => ':memory:',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ));
        $db->bootEloquent();
        $db->setAsGlobal();
    }

    public function migrateDiseaseTable()
    {
        DB::schema()->create('disease', function($table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('caseAmount');
        });

        DB::schema()->create('statistic', function ($table){
            $table->increments('id');
            $table->unsignedBigInteger('disease_id');
            $table->unsignedBigInteger('locality_id');
            $table->foreign('disease_id')->references('id')->on('disease');
            $table->foreign('locality_id')->references('id')->on('locality');
        });
        Disease::create(array('name' => 'Covid', 'caseAmount' => 15));
    }

    public function migrateLocalityTable(){
        DB::schema()->create('locality', function($table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('population');
        });
        $locality = Locality::create(array('name' => 'yablunivka', 'population' => 465));
        $locality->diseases()->attach(Disease::find(1));

    }

    public function testGetDiseases_usersEmailNotVerified_throwMethodAccessDeniedException(){
        $user = new User(1, 1, 'Stass', 'user', false);
        SecurityContext::setUser($user);

        $this->expectExceptionMessage("Access for method denied");
        DiseaseService::getDiseases();
    }

    public function testGetDiseases_diseaseFromDAL_correctMappingToDiseaseDTO(){
        $user = new User(1, 1, 'Stass', 'user', true);
        SecurityContext::setUser($user);

        $diseasesDto = DiseaseService::getDiseases();
        $this->assertEquals(1, $diseasesDto[0]->id);
        $this->assertEquals('Covid', $diseasesDto[0]->name);
        $this->assertEquals(15, $diseasesDto[0]->caseAmount);

    }
}