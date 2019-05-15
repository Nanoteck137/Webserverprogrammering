<?php

require("./private/api/database.php");

$database = new Database();

$result = $database->Query("SELECT * FROM users");

echo var_dump($result->GetRow(0));

?>