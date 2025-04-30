<?php
$host = 'localadmin';
$name = 'x';
$user = "x";
$password = "x";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $password);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
?>