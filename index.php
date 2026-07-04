<?php
require 'config.php';

$db = new SQLite3(__DIR__.'/database/panel.db');

$pageTitle = "TRENZYCH VPN";

$totalServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers");
$totalKeys = (int)$db->querySingle("SELECT COUNT(*) FROM vpn_keys");
$onlineServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers WHERE status=1");

include 'includes/header.php';
include 'includes/navbar.php';
?>

<section class="hero">

<div class="container">

<div class="hero-content">

<span class="hero-badge">
Fast • Secure • Stable
</span>

<h1>TRENZYCH VPN</h1>

<p class="hero-subtitle">
Secure, fast and reliable VPN service for everyday browsing,
gaming and streaming.
</p>

<div class="hero-buttons">

<a href="free.php" class="btn">
🗝️ Free VPN Key
</a>

<a href="vip.php" class="btn btn-outline">
💎 VIP Paid Plan
</a>

</div>

</div>

</div>

</section>
<section class="why">

<div class="container">

<div class="section-title">
<h2>Why Choose TRENZYCH VPN?</h2>
<p>Fast, secure and reliable VPN experience for everyone.</p>
</div>

<div class="why-grid">

<div class="why-card">
<div class="why-icon">⚡</div>
<h3>Ultra Fast</h3>
<p>10Gbps network with low latency and stable routing.</p>
</div>

<div class="why-card">
<div class="why-icon">🔒</div>
<h3>Secure</h3>
<p>Powered by modern VPN protocols with strong encryption.</p>
</div>

<div class="why-card">
<div class="why-icon">🌍</div>
<h3>Global Servers</h3>
<p>Connect to multiple countries with reliable performance.</p>
</div>

<div class="why-card">
<div class="why-icon">🛡</div>
<h3>99.9% Uptime</h3>
<p>Highly available servers monitored around the clock.</p>
</div>

</div>

</div>

</section>

<?php include 'includes/footer.php'; ?>
