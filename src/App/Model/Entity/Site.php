<?php

namespace App\Model\Entity;

use Core\Entity\Entity;

class Site extends Entity
{
    public $id;
    public $url;

    public function __construct($id, $url)
    {
        $this->id = $id;
        $this->url = $url;
    }
}
