<?php

namespace App\Model\Entity;

use Core\Entity\Entity;

class Destination extends Entity
{
    public $id;
    public $countryName;
    public $conjunction;
    public $name;
    public $computerName;

    public function __construct($id, $countryName, $conjunction, $computerName)
    {
        $this->id = $id;
        $this->countryName = $countryName;
        $this->conjunction = $conjunction;
        $this->computerName = $computerName;
    }
}
