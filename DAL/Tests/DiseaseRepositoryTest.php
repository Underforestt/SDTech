<?php


namespace SDTech\DAL\Tests;

require "Database.php";
use DB\Database;
use PHPUnit\Framework\TestCase;
use SDTech\DAL\Entities\Disease;
use SDTech\DAL\Repositories\Impl\DiseaseRepository;
use Illuminate\Database\Capsule\Manager as DB;


class DiseaseRepositoryTest extends TestCase
{
    public function setUp()
    {
        $this->configureDatabase();
        $this->migrateIdentitiesTable();
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

    public function migrateIdentitiesTable()
    {
        DB::schema()->create('disease', function($table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('caseAmount');
        });
        Disease::create(array('name' => 'Covid', 'caseAmount' => 15));
        Disease::create(array('name' => 'Flu', 'caseAmount' => 7));

    }

    public function testGetDiseaseExists()
    {
        $result = DiseaseRepository::get(1)->toArray();
        $expected = array(
            'id' => 1,
            'name' => 'Covid',
            'caseAmount' => 15
        );
        $this->assertEquals($expected, $result);
    }

    public function testGetDiseaseNotExists(){
        $result = DiseaseRepository::get(55);
        $expected = null;
        $this->assertEquals($expected, $result);
    }

    public function testCreateDisease(){
        $disease = DiseaseRepository::create([
            'name' => 'Cancer',
            'caseAmount' => 10
        ])->toArray();

        $this->assertNotNull(DiseaseRepository::get($disease['id']));

    }

    public function testDeleteDiseaseExists(){
        DiseaseRepository::delete(1);

        $this->assertNull(DiseaseRepository::get(1));
    }

    public function testDeleteDiseaseNotExists(){
        $actual = DiseaseRepository::delete(6);
        $this->assertEquals(null, $actual);
    }
}