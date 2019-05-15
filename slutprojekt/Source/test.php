<?php

require("./private/api/database.php");
require("./private/api/auth.php");

$database = new Database();

$result = $database->Query("SELECT * FROM users");

echo var_dump($result->GetRow(0));

echo "<br>";

$auth = new Auth($database);
echo var_dump($auth->GetUserByEmail("patrik.millvik@gmail.com"));

?>