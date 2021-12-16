<?php


namespace SDTech\DAL\Repositories\Impl;

use SDTech\DAL\Entities\Disease;
use SDTech\DAL\Repositories\Interfaces\DiseaseRepInterface;

class DiseaseRepository implements DiseaseRepInterface
{

    public function create($properties)
    {
        return Disease::create([
            'name' => $properties['name'],
            'caseAmount' => $properties['caseAmount']
        ]);

    }

    public function update(int $id, $properties)
    {
        $disease = Disease::find($id);

        $disease->name = $properties['name'];
        $disease->caseAmount = $properties['caseAmount'];
        $disease->save();
    }

    public function get(int $id)
    {
        return Disease::find($id);
    }

    public function delete(int $id)
    {
        $disease = Disease::find($id);
        if ($disease){
            $disease->delete();
        }
        return null;
    }

    public function getAll()
    {
        return Disease::all();
    }
}