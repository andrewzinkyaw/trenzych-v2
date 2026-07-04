<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: servers.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $db->prepare("DELETE FROM servers WHERE id=:id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->execute();

header("Location: servers.php");
exit;
