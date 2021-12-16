<?php


namespace SDTech\DAL\Repositories\Impl;


use SDTech\DAL\Entities\Disease;
use SDTech\DAL\Entities\Locality;
use SDTech\DAL\Repositories\Interfaces\LocalityRepInterface;
use SDTech\Middleware\Middleware;

class LocalityRepository implements LocalityRepInterface, \SplSubject
{
    private $diseases = [];
    private $observers = [];
    private $middleware;

    public function __construct()
    {
        $this->observers["*"] = [];
    }

    public function setMiddleware(Middleware $middleware): void
    {
        $this->middleware = $middleware;
    }

    private function initEventGroup(string $event = "*"): void
    {
        if (!isset($this->observers[$event])) {
            $this->observers[$event] = [];
        }
    }

    private function getEventObservers(string $event = "*"): array
    {
        $this->initEventGroup($event);
        $group = $this->observers[$event];
        $all = $this->observers["*"];

        return array_merge($group, $all);
    }

    public function attach(\SplObserver $observer, string $event = "*"): void
    {
        $this->initEventGroup($event);

        $this->observers[$event][] = $observer;
    }

    public function detach(\SplObserver $observer, string $event = "*"): void
    {
        foreach ($this->getEventObservers($event) as $key => $s) {
            if ($s === $observer) {
                unset($this->observers[$event][$key]);
            }
        }
    }

    public function notify(string $event = "*", $data = null): void
    {
        foreach ($this->getEventObservers($event) as $observer) {
            $observer->update($this, $event, $data);
        }
    }

    public function getAll()
    {
        return Locality::all();
    }

    public function get(int $id)
    {
        return Locality::find($id);
    }

    public function create($properties)
    {
        if (isset($this->middleware) && !$this->middleware->check($properties)){
            return;
        }
        $locality = Locality::create([
            'name' => $properties['name'],
            'population' => $properties['population']
        ]);
        $this->notify("locality:created");
        $locality->save();
    }

    public function update(int $id, $properties)
    {
        $locality = Locality::find($id);
        $locality->name = $properties['name'];
        $locality->population = $properties['population'];

        $locality->save();
    }

    public function delete(int $id)
    {
        $locality = Locality::find($id);
        $locality->diseases()->delete();
        $locality->delete();
    }

    public function addDisease(int $localityId, int $diseaseId){
        $locality = Locality::find($localityId);
        if ($locality->diseases()->find($diseaseId) === null){
            $locality->diseases()->attach($diseaseId);
        }
    }
}