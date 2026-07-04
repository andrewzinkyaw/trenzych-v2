<?php
if (!isset($pageTitle)) {
    $pageTitle = "TRENZYCH VPN";
}

if (!isset($themeColor)) {
    $themeColor = "#e11d48";
}

if (!isset($favicon)) {
    $favicon = "favicon.ico";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo htmlspecialchars($pageTitle); ?></title>

<meta name="description" content="TRENZYCH VPN - Fast • Secure • Stable VPN Service">
<meta name="keywords" content="VPN, VLESS, Shadowsocks, Hysteria, TRENZYCH VPN">
<meta name="author" content="TRENZYCH VPN">

<meta name="theme-color" content="<?php echo htmlspecialchars($themeColor); ?>">

<link rel="icon" href="/assets/images/<?php echo htmlspecialchars($favicon); ?>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="/assets/css/main.css">
<link rel="stylesheet" href="/assets/css/navbar.css">
<link rel="stylesheet" href="/assets/css/home.css">

<style>
:root{
    --primary:#e11d48;

    --bg:#020617;
    --surface:#0f172a;
    --surface-2:#1e293b;

    --text:#f8fafc;
    --text-muted:#94a3b8;

    --border:rgba(255,255,255,.08);

    --radius:16px;

    --transition:.25s;
}

[data-theme="light"]{
    --bg:#f8fafc;
    --surface:#ffffff;
    --surface-2:#f1f5f9;

    --text:#0f172a;
    --text-muted:#475569;

    --border:rgba(15,23,42,.08);
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{
    font-family:'Inter',sans-serif;

    background:var(--bg);

    color:var(--text);

    transition:
        background var(--transition),
        color var(--transition);

    line-height:1.6;
}

a{
    text-decoration:none;
    color:inherit;
}

img{
    max-width:100%;
    display:block;
}

.container{
    width:min(1200px,92%);
    margin:auto;
}

section{
    padding:80px 0;
}

.card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:var(--radius);
    transition:all var(--transition);
}

.card:hover{
    transform:translateY(-4px);
}

.btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;

    gap:10px;

    padding:14px 24px;

    border-radius:14px;

    background:var(--primary);

    color:#fff;

    font-weight:700;

    transition:all var(--transition);
}

.btn:hover{
    transform:translateY(-2px);
    opacity:.95;
}
</style>

</head>

<body>

<div id="page">
