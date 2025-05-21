<?php
// includes/session.php
session_start();
require '../db.php';

$defaultTimeout = 30;
$userId = $_SESSION['userid'] ?? null;
$timeout = $defaultTimeout;

if ($userId) {
    $stmt = $mysql->prepare("SELECT timeout_seconds FROM users WHERE id = :id");
    $stmt->execute([':id' => $userId]);
    $timeout = $stmt->fetchColumn() ?: $defaultTimeout;
}
// Wurde schon mal eine letzte Aktivität protokolliert?
if (isset($_SESSION['last_activity'])) {
    // Prüfen, ob die Differenz größer als das Timeout ist
    if (time() - $_SESSION['last_activity'] > $timeout) {
        session_unset();
        session_destroy();
        // Weiterleitung zum Login mit Timeout-Flag
        header("Location: Nebenseiten/login.php?timeout=1");
        exit;
    }
}
// Immer den aktuellen Timestamp als letzte Aktivität speichern
$_SESSION['last_activity'] = time();
?>