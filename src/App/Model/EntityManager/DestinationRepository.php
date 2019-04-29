<?php

namespace App\Model\EntityManager;

use Core\Database\MysqlDatabase;
use App\Model\Entity\Connexion;

class DestinationRepository implements Repository
{
    private $country;
    private $conjunction;
    private $computerName;
    private $db;

    /**
     * DestinationRepository constructor.
     */
    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
        $this->country = Faker\Factory::create()->country;
        $this->conjunction = 'en';
        $this->computerName = Faker\Factory::create()->slug();
    }

    /**
     * @param int $id
     *
     * @return Destination
     */
    public function getById($id)
    {
        // DO NOT MODIFY THIS METHOD
        return new Destination(
            $id,
            $this->country,
            $this->conjunction,
            $this->computerName
        );
    }
}
