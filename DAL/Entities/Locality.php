<?php


namespace SDTech\DAL\Entities;


use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    protected $table = 'locality';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'population'
    ];

    public function diseases(){
        return $this->belongsToMany(Disease::class, 'statistic');
    }
}

