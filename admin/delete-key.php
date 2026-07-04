<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: keys.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

$stmt = $db->prepare("DELETE FROM vpn_keys WHERE id = :id");
$stmt->bindValue(':id', (int)$_GET['id'], SQLITE3_INTEGER);
$stmt->execute();

header("Location: keys.php");
exit;
