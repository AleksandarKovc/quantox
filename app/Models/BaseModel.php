<?php

namespace App\Models;

use App\Services\DBService;

class BaseModel
{

    /**
     * @var DBService
     */
    protected $dbService;

    /**
     * BaseModel constructor.
     */
    public function __construct()
    {
        $this->dbService = new DBService();
    }
}
