<?php

namespace SDTech\DAL\Repositories\Impl;

use PDOException;
use SDTech\DAL\Repositories\Interfaces\Repository;


class Retry implements Repository
{
    private Repository $repo;
    private int $retry;

    public function __construct(Repository $repo, int $retry)
    {
        $this->repo = $repo;
        $this->retry = $retry;
    }

    public function getAll()
    {
        return $this->retry(__FUNCTION__, func_get_args());
    }

    public function get(int $id)
    {
        return $this->retry(__FUNCTION__, func_get_args());
    }

    public function create($properties)
    {
        return $this->retry(__FUNCTION__, func_get_args());

    }

    public function update(int $id, $properties)
    {
        return $this->retry(__FUNCTION__, func_get_args());
    }

    public function delete(int $id)
    {
        return $this->retry(__FUNCTION__, func_get_args());
    }

    protected function retry(string $method, array $metArgs)
    {
        $retry = max($this->retry, 0);
        do {
            try {
                return $this->repo->$method(...$metArgs);
            } catch (PDOException $exception) {
                if ($retry <= 0) {
                    throw $exception;
                }
                print "\nRetrying connection...\n";
            }
        } while ($retry--);
    }
}


