<?php

namespace App\Model\EntityManager;

use Core\Database\MysqlDatabase;
use App\Model\Entity\Connexion;

class SiteRepository implements Repository
{
    private $url;
    private $db;

    /**
     * SiteRepository constructor.
     *
     */
    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
        // DO NOT MODIFY THIS METHOD
        $this->url = Faker\Factory::create()->url;
    }

    /**
     * @param int $id
     *
     * @return Site
     */
    public function getById($id)
    {
        // DO NOT MODIFY THIS METHOD
        return new Site($id, $this->url);
    }
}
