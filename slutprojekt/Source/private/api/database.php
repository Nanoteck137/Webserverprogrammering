<?php

class DatabaseQueryExeception extends Exception {}

class DatabaseResult
{
    private $rows;
    private $numRows;

    public function __construct(array $rows, int $numRows)
    {
        $this->rows = $rows;
        $this->numRows = $numRows;
    }

    public function GetRow(int $index) 
    {
        return $this->rows[$index];
    }
}

class Database
{
    private $connection;

    public function __construct() {
        $this->connection = new mysqli("localhost", "root", "", "stackunderflow");
    }

    public function Query(string $query) {
        $result = $this->connection->query($query);
        if(!$result)
            throw new DatabaseQueryExeception("Malformed query '$query'");

        return new DatabaseResult($result->fetch_all(), $result->num_rows);
    }
}

?>