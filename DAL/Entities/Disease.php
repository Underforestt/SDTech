<?php


namespace SDTech\DAL\Entities;

use Illuminate\Database\Eloquent\Model;


class Disease extends Model
{
    protected $table = 'disease';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'caseAmount'
    ];
}