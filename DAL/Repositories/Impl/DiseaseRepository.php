<?php


namespace SDTech\DAL\Repositories\Impl;


use SDTech\DAL\Entities\Disease;
use SDTech\DAL\Repositories\Interfaces\DiseaseRepInterface;

class DiseaseRepository implements DiseaseRepInterface
{

    public static function create($properties)
    {
        return Disease::create([
            'name' => $properties['name'],
            'caseAmount' => $properties['caseAmount']
        ]);

    }

    public static function update(int $id, $properties)
    {
        $disease = Disease::find($id);

        $disease->name = $properties['name'];
        $disease->caseAmount = $properties['caseAmount'];
        $disease->save();
    }

    public static function get(int $id)
    {
        return Disease::find($id);
    }

    public static function delete(int $id)
    {
        $disease = Disease::find($id);
        if ($disease){
            $disease->delete();
        }
        return null;
    }

    public static function getAll()
    {
        return Disease::all();
    }
}