<?php


namespace SDTech\BLL\DTO;


class DiseaseDTO
{
    public int $id;
    public string $name;
    public int $caseAmount;

    public function __construct(int $diseaseId, string $name, int $caseAmount){
        $this->id = $diseaseId;
        $this->name = $name;
        $this->caseAmount = $caseAmount;
    }

}