<?php

function testgenConnect(){
    $server = 'localhost';
    $username = 'iClient';
    $password = 'EQWJTxs7ZwA1uaj3';
    
    //$server = 'markchmieleski62405.ipagemysql.com';
    $dbname= 'testgen';
    //$username = "blazzard";
    //$password = 'Boston88!!';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e) {
        echo $e;
        //header('Location: ../views/500.php');
        exit;
    }
}