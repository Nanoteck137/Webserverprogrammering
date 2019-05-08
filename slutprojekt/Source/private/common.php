<?php

function my_log(string $message) {
    //error_log($message, 3, );
    $socket = socket_create(AF_INET, SOCK_STREAM, 0);
    
    socket_connect($socket, "192.168.24.87", 12345);
    
    $obj->type = 1;
    $obj->message = $message;
    $obj->time = time();

    socket_write($socket, json_encode($obj));
    //$result = socket_read($socket, 1024);
    
    //echo "Result from server: " . $result;
}

?>