<?php


namespace SDTech\DAL\Repositories\Interfaces;


interface Repository
{
    public function getAll();
    public function get(int $id);
    public function predicate($predicate);
    public function create($item);
    public function update($item);
    public function delete($item);
}