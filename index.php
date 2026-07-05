<?php
require 'config.php';

$db = new SQLite3(__DIR__ . '/database/panel.db');

$pageTitle = "TRENZYCH VPN";

$totalServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers");
$totalKeys = (int)$db->querySingle("SELECT COUNT(*) FROM vpn_keys");
$onlineServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers WHERE status = 1");

include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- =========================
        HERO SECTION
========================= -->

<section class="hero">

<div class="container">

<div class="hero-content">

<span class="hero-badge">
 Fast • Secure • Stable
</span>

<h1>
TRENZYCH
</h1>

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

<!-- =========================
        LIVE STATS
========================= -->

<section class="stats animate">

<div class="container">

<div class="stats-grid">

<a href="free.php" class="stat-card">

<div class="stat-icon">
🔑
</div>

<div class="stat-number">
<?php echo $totalKeys; ?>
</div>

<div class="stat-label">
VPN Keys
</div>

</a>

<a href="status.php" class="stat-card">

<div class="stat-icon">
🖥️
</div>

<div class="stat-number">
<?php echo $totalServers; ?>
</div>

<div class="stat-label">
Servers
</div>

</a>

<a href="status.php" class="stat-card">

<div class="stat-icon">
🟢
</div>

<div class="stat-number">
<?php echo $onlineServers; ?>
</div>

<div class="stat-label">
Online
</div>

</a>

<a href="https://t.me/trenzych" class="stat-card" target="_blank">

<div class="stat-icon">
💬
</div>

<div class="stat-number">
24/7
</div>

<div class="stat-label">
Support
</div>

</a>

</div>

</div>

</section>

<!-- =========================
     WHY CHOOSE SECTION
========================= -->

<section class="why animate">

<div class="container">

<div class="section-title">

<h2>
Why Choose TRENZYCH VPN?
</h2>

<p>
Fast, secure and reliable VPN experience for everyone.
</p>

</div>

<div class="why-grid"><div class="why-card">

<div class="why-icon">
⚡
</div>

<h3>
Ultra Fast Speed
</h3>

<p>
Premium 10Gbps servers with optimized routing for gaming,
streaming and everyday browsing.
</p>

</div>

<div class="why-card">

<div class="why-icon">
🔒
</div>

<h3>
Secure Connection
</h3>

<p>
Modern VPN protocols with strong encryption to protect your
privacy and online activity.
</p>

</div>

<div class="why-card">

<div class="why-icon">
🌍
</div>

<h3>
Global Servers
</h3>

<p>
Connect through multiple countries with stable performance
and low latency.
</p>

</div>

<div class="why-card">

<div class="why-icon">
🛡️
</div>

<h3>
99.9% Uptime
</h3>

<p>
Reliable infrastructure with continuous monitoring to keep
your VPN available anytime.
</p>

</div>

</div>

</div>

</section>

<!-- =========================
      SERVER LOCATIONS
========================= -->

<section class="locations animate">

<div class="container">

<div class="section-title">

<h2>
🌍 Server Locations
</h2>

<p>
Choose the fastest server closest to you.
</p>

</div>

<div class="location-grid">

<div class="location-card">
🇸🇬
<h3>Singapore</h3>
<p>Low Latency</p>
</div>

<div class="location-card">
🇯🇵
<h3>Japan</h3>
<p>Gaming Ready</p>
</div>

<div class="location-card">
🇺🇸
<h3>United States</h3>
<p>Streaming</p>
</div>

<div class="location-card">
🇬🇧
<h3>United Kingdom</h3>
<p>Stable Route</p>
</div>

</div>

</div>

</section>

<!-- =========================
      DOWNLOAD PREVIEW
========================= -->

<section class="downloads animate">

<div class="container">

<div class="section-title">

<h2>
📥 Download Apps
</h2>

<p>
Use your favorite VPN client on any device.
</p>

</div>

<div class="download-grid"><a href="downloads.php" class="download-card">

<div class="download-icon">
🤖
</div>

<h3>
Android
</h3>

<p>
V2RayNG, Hiddify, Clash Meta
</p>

</a>

<a href="downloads.php" class="download-card">

<div class="download-icon">
🍎
</div>

<h3>
iPhone / iPad
</h3>

<p>
Shadowrocket & Streisand
</p>

</a>

<a href="downloads.php" class="download-card">

<div class="download-icon">
💻
</div>

<h3>
Windows
</h3>

<p>
Nekoray, Clash Verge & Hiddify
</p>

</a>

<a href="downloads.php" class="download-card">

<div class="download-icon">
🐧
</div>

<h3>
Linux / macOS
</h3>

<p>
Cross-platform VPN clients
</p>

</a>

</div>

</div>

</section>

<!-- =========================
          FAQ PREVIEW
========================= -->

<section class="faq animate">

<div class="container">

<div class="section-title">

<h2>
❓ Frequently Asked Questions
</h2>

<p>
Quick answers to common questions.
</p>

</div>

<div class="faq-list">

<div class="faq-item">

<h3>
Is the Free VPN really free?
</h3>

<p>
Yes. You can use our free VPN keys with supported clients.
</p>

</div>

<div class="faq-item">

<h3>
What is included in VIP?
</h3>

<p>
VIP includes premium routing, higher speeds, priority support and more devices.
</p>

</div>

<div class="faq-item">

<h3>
How can I contact support?
</h3>

<p>
Contact us anytime through our Telegram support.
</p>

</div>

</div>

</div>

</section><!-- =========================
        FINAL CTA
========================= -->

<section class="hero">

<div class="container">

<div class="hero-content">

<h2>
Ready to Get Started?
</h2>

<p class="hero-subtitle">
Choose the plan that fits your needs and enjoy a fast, secure and stable VPN experience.
</p>

<div class="hero-buttons">

<a href="free.php" class="btn">
🗝️ Get Free VPN Key
</a>

<a href="vip.php" class="btn btn-outline">
💎 Upgrade to VIP
</a>

</div>

</div>

</div>

</section>

<?php include 'includes/footer.php'; ?>
