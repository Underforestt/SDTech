<?php


namespace SDTech\DAL\Repositories\Impl;


use SDTech\DAL\Entities\Disease;
use SDTech\DAL\Entities\Locality;

class LocalityRepository implements \SDTech\DAL\Repositories\Interfaces\LocalityRepInterface
{

    public static function getAll()
    {
        return Locality::all();
    }

    public static function get(int $id)
    {
        return Locality::find($id);
    }

    public static function create($properties)
    {
        $locality = Locality::create([
            'name' => $properties['name'],
            'population' => $properties['population']
        ]);

        $locality->save();
    }

    public static function update(int $id, $properties)
    {
        $locality = Locality::find($id);
        $locality->name = $properties['name'];
        $locality->population = $properties['population'];

        $locality->save();
    }

    public static function delete(int $id)
    {
        $locality = Locality::find($id);
        $locality->diseases()->delete();
        $locality->delete();
    }

    public static function addDisease(int $localityId, int $diseaseId){
        $locality = Locality::find($localityId);
        if ($locality->diseases()->find($diseaseId) === null){
            $locality->diseases()->attach($diseaseId);
        }
    }
}