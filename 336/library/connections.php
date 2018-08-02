<?php

function acmeConnect(){
    $server = 'localhost';
    $dbname= 'acme';
    $username = 'visitor';
    $password = 'cangetin';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection object and assign it to a variable
    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e) {
        header('Location: /view/500.php');
        exit;
    }
}
/*
echo "<table style='border: solid 1px black;'>";
// echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$sql = "SELECT * FROM inventory;";

$stmt = acmeConnect()->prepare($sql);
$stmt->execute();




// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
    echo $v;
}
$stmt = null;
echo "</table>";*/
