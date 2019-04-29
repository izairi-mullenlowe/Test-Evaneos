<?php

namespace App\Model\EntityManager;

use Core\Database\MysqlDatabase;
use App\Model\Entity\Connexion;

class QuoteRepository implements Repository
{
    private $siteId;
    private $destinationId;
    private $date;
    private $db;

    /**
     * QuoteRepository constructor.
     */
    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
        // DO NOT MODIFY THIS METHOD
        $generator = Faker\Factory::create();

        $this->siteId = $generator->numberBetween(1, 10);
        $this->destinationId = $generator->numberBetween(1, 200);
        $this->date = new DateTime();
    }

    /**
     * @param int $id
     *
     * @return Quote
     */
    public function getById($id)
    {
        // DO NOT MODIFY THIS METHOD
        return new Quote(
            $id,
            $this->siteId,
            $this->destinationId,
            $this->date
        );
    }
}
