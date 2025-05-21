<?php

$config = parse_ini_file(__DIR__ . '/../config.ini', true);

$host = $config['database']['host'];
$name = $config['database']['name'];
$user = $config['database']['user'];
$password = $config['database']['password'];

try {
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $password);
} catch (PDOException $e) {
    echo "SQL Error: " . $e->getMessage();
}
?>