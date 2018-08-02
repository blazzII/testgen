<?php

function testgenConnect(){
    $server = 'localhost';
    $dbname= 'test';
    $username = 'iClient';
    $password = 'Boston77!';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e) {
        header('Location: /views/500.php');
        exit;
    }
}