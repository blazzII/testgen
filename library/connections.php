<?php

function testgenConnect(){
    $server = 'localhost';
    $dbname= 'testgen';
    $username = 'iClient';
    $password = 'EQWJTxs7ZwA1uaj3';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e) {
        echo $e;
        //header('Location: /testgen/views/500.php');
        exit;
    }
}