<?php
require 'config.php';

$db = new SQLite3(__DIR__ . '/database/panel.db');

$totalServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers");
$totalKeys = (int)$db->querySingle("SELECT COUNT(*) FROM vpn_keys");
$onlineServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers WHERE status=1");

include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/hero.php';
include 'includes/features.php';
include 'includes/stats.php';
include 'includes/server-preview.php';
include 'includes/download-preview.php';
include 'includes/faq-preview.php';
include 'includes/footer.php';
