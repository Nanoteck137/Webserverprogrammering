<?php

require("./private/api/database.php");
require("./private/api/auth.php");
require("./private/api/forum.php");

$database = new Database();

$result = $database->Query("SELECT * FROM users");

echo var_dump($result->GetRow(0));

echo "<br>";

$auth = new Auth($database);
echo var_dump($auth->GetUserByEmail("patrik.millvik@gmail.com"));

$forum = new Forum($database, $auth);

echo "<br>";
echo "<br>";
echo "<br>";


//echo var_dump($forum->GetAllPosts());

?>