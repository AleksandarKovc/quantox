<?php

namespace App\Services;

use mysqli;

class DBService
{

    /**
     * @var mysqli
     */
    private $connection;

    /**
     * DBService constructor. Performs connection to database.
     */
    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "admin";

        $conn = new mysqli($servername, $username, $password);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $this->connection = $conn;
    }

    /**
     * Executes given query.
     *
     * @param string $query Query for executing.
     *
     * @return array|null
     */
    public function query($query)
    {
        $result = $this->connection->query($query);

        return $result->fetch_assoc();
    }
}
