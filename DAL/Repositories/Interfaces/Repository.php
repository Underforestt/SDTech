<?php


namespace SDTech\DAL\Repositories\Interfaces;


interface Repository
{
    public static function getAll();
    public static function get(int $id);
    public static function create($properties);
    public static function update(int $id, $properties);
    public static function delete(int $id);
}