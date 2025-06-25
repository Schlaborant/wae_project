<?php
session_start();
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['cart']) || !is_array($data['cart'])) {
  echo json_encode(["success" => false, "message" => "Ungültige Daten"]);
  exit;
}

$_SESSION['cart'] = $data['cart'];

echo json_encode(["success" => true]);
?>