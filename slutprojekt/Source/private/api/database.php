<?php

// Excpetion for a malformed database query
class DatabaseQueryException extends Exception {}

// DatabaseResult: Has all the rows for the query
class DatabaseResult
{
    private $rows;
    private $numRows;

    public function __construct(array $rows, int $numRows)
    {
        $this->rows = $rows;
        $this->numRows = $numRows;
    }

    public function GetNumRows(): int 
    {
        return $this->numRows;
    }

    public function GetRow(int $index) 
    {
        return $this->rows[$index];
    }
}

// Database Object: Wrapper around mysqli with a nicer interface WIP
class Database
{
    // The database connection
    private $connection;

    // Constructor for this object
    public function __construct() 
    {
        $this->connection = new mysqli("localhost", "root", "", "stackunderflow");
    }

    // Query the database for data
    public function Query(string $query) 
    {
        $result = $this->connection->query($query);
        if(!$result)
            throw new DatabaseQueryException("Malformed query '$query'");

        if(is_bool($result))
        {
            return new DatabaseResult(array(), 0);
        } 
        else 
        {
            return new DatabaseResult($result->fetch_all(MYSQLI_BOTH), $result->num_rows);
        }

        return null;
    }
}

?>