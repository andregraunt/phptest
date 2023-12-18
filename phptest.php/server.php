<?php

$host = 'localhost';
$port = 8888;

$socket = socket_create(AF_INET, SOCK_STREAM, 0);
socket_bind($socket, $host, $port);
socket_listen($socket);

echo "Serving HTTP on port {$port} ...\n";

while (true) {
    $client = socket_accept($socket);

    $request = socket_read($client, 1024);

    if (strpos($request, 'index.php') !== false) {
        $response = "HTTP/1.1 200 OK\r\n\r\nIndex page content here.";
    } else {
        $response = "HTTP/1.1 200 OK\r\n\r\nHello, World!";
    }
    socket_write($client, $response, strlen($response));
    socket_close($client);
}



