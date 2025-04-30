<?php
$host = 'localhost';
$name = 'mealy_shop';
$user = "admin";
$password = "admin";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $password);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
?>