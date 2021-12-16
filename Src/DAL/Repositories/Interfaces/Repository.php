<?php


namespace SDTech\DAL\Repositories\Interfaces;


interface Repository
{
    public function getAll();
    public function get(int $id);
    public function create($properties);
    public function update(int $id, $properties);
    public function delete(int $id);
}