<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TRENZYCH Admin v2</title>

<link rel="stylesheet" href="assets/css/admin.css">
<script src="assets/js/admin.js" defer></script>

</head>
<body>

<header class="topbar">

<button id="menuToggle" class="menu-toggle">
☰
</button>

<div class="topbar-title">
🚀 TRENZYCH Admin v2
</div>

<div class="topbar-user">
👤 Admin
</div>

</header>

<div class="admin-wrapper">
