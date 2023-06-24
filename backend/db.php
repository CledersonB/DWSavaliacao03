<?php
    $connection = new mysqli('localhost', 'root', '290389', 'veiculos_tesla');
    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }
?>