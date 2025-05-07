<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'mealy_shop';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>
