<?php
declare(strict_types=1);

session_start();

$db = new PDO(
    'sqlite:/var/www/html/trenzych-v2/database/panel.db'
);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

function isLoggedIn(): bool
{
    return isset($_SESSION['admin']);
}

function redirect(string $url): void
{
    header("Location: $url");
    exit;
}
