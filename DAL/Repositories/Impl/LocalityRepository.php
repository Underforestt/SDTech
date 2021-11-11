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

        foreach ($properties['diseases'] as $disease){
            $locality->diseases()->attach($disease->id);
        }
        $locality->save();
    }

    public static function update(int $id, $properties)
    {
        $locality = Locality::find($id);
        $locality->name = $properties['name'];
        $locality->population = $properties['population'];

        if (isset($population['diseases'])){
            foreach ($population['diseases'] as $disease){
                $locality->diseases()->attach($disease->id);
            }
        }
        $locality->save();
    }

    public static function delete(int $id)
    {
        $locality = Locality::find($id);
        $locality->diseases()->delete();
        $locality->delete();
    }
}