<?php

require_once("private/api/database.php");
require_once("private/api/auth.php");

$database = null;
$auth = null;

function common_start() 
{
    session_start();
    
    global $database;
    global $auth;

    $database = new Database();
    $auth = new Auth($database);
}

function my_log(string $message) 
{
    if(!function_exists("socket_create"))
        return;

    $socket = socket_create(AF_INET, SOCK_STREAM, 0);
    if(!$socket) 
        return;
    
    $result = @socket_connect($socket, "localhost", 12345);
    
    if(!$result)
        return;

    $obj = new stdClass();
    $obj->type = 1;
    $obj->message = $message;
    $obj->time = time();

    socket_write($socket, json_encode($obj));

    socket_close($socket);
}

function format_time($time)
{
    $time = time() - $time;
    $time = ($time < 1) ? 1 : $time;

    $tokens = array(
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) 
    {
        if ($time < $unit) continue;

        $numberOfUnits = floor($time / $unit);
        
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
    }
}

function format_time_data($time_data) 
{
    return format_time(strtotime($time_data));
}

?>