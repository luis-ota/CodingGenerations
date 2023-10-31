<?php
    $dbServerName = '127.0.0.1';
    $dbUserName = 'root';
    $dbPassword = 'PUC@1234';
    $dbName = 'projetocg';

    $connection = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);
    if($connection->connect_error) {
        echo "$connection->connect_error";
        die("Connection failed: " . $connection->connect_error);
    }
?>