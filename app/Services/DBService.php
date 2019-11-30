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
     * Executes given query. Returns multiple resultSet.
     *
     * @param string $query Query for executing.
     *
     * @return array|null
     */
    public function get($query)
    {
        $result = $this->connection->query($query);

        $resultSet = [];
        while ($cRecord = $result->fetch_assoc()) {
            $resultSet[] = $cRecord;
        }

        return $resultSet;
    }

    /**
     * @param $query
     *
     * @return string
     */
    public function set($query)
    {
        try {
            $this->connection->query($query);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return 'Record inserted successfully.';
    }

    /**
     * Return single record from db.
     *
     * @param string $query Query for executing.
     *
     * @return array|null
     */
    public function findOne($query)
    {
        $result = $this->connection->query($query);

        return $result->fetch_assoc();
    }
}
