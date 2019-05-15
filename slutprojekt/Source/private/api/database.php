<?php

class DatabaseResult
{
    private $data;
    private $numRows;

    public function __construct(mixed $data, int $numRows)
    {
        
    }
}

class Database
{
    private $connection;

    public function __construct() {
        $this->connection = new mysqli("localhost", "root", "", "stackunderflow");
    }

    public function Query(string $query) {
        return $this->connection->query($query);
    }
}

?>