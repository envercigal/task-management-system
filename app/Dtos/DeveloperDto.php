<?php

namespace App\Dtos;

class DeveloperDto
{
    public $name;

    public $capacityPerHour;

    public function __construct($name, $capacityPerHour)
    {
        $this->name = $name;
        $this->capacityPerHour = $capacityPerHour;
    }
}
