<?php
require 'config.php';

$db = new SQLite3(__DIR__ . '/database/panel.db');

function getSetting($db, $key){
    $stmt = $db->prepare("
        SELECT setting_value
        FROM settings
        WHERE setting_key=:key
        LIMIT 1
    ");
    $stmt->bindValue(':key',$key,SQLITE3_TEXT);
    $result=$stmt->execute()->fetchArray(SQLITE3_ASSOC);
    return $result ? $result['setting_value'] : '';
}

$pageTitle = "Premium VPN";

include 'includes/header.php';
?>

<link rel="stylesheet" href="/assets/css/vip.css">

<?php include 'includes/navbar.php'; ?>

<section class="vip-hero">

<div class="container">

<span class="badge">
PREMIUM VPN
</span>

<h1>
Premium Plans
</h1>

<p>
Fast • Secure • Stable VPN Service
</p>

</div>

</section>
<section class="vip-plans">

<div class="container">

<div class="plans">

<div class="plan-card">

<span class="plan-badge">BASIC</span>

<h2>5,000 Ks</h2>

<ul>
<li>✔ 1 Month</li>
<li>✔ 1 Device</li>
<li>✔ 150 GB</li>
<li>✔ Full Speed</li>
</ul>

<a href="https://t.me/andrew_ms_7" class="buy-btn" target="_blank">
BUY NOW
</a>

</div>

<div class="plan-card featured">

<div class="popular">
MOST POPULAR
</div>

<span class="plan-badge">STANDARD</span>

<h2>8,000 Ks</h2>

<ul>
<li>✔ 1 Month</li>
<li>✔ 2 Devices</li>
<li>✔ 300 GB</li>
<li>✔ Priority Support</li>
</ul>

<a href="https://t.me/andrew_ms_7" class="buy-btn" target="_blank">
BUY NOW
</a>

</div>

<div class="plan-card">

<span class="plan-badge">PREMIUM</span>

<h2>15,000 Ks</h2>

<ul>
<li>✔ 1 Month</li>
<li>✔ 5 Devices</li>
<li>✔ Unlimited Data</li>
<li>✔ VIP Support</li>
</ul>

<a href="https://t.me/andrew_ms_7" class="buy-btn" target="_blank">
BUY NOW
</a>

</div>

</div>

</div>

</section>

<?php include 'includes/footer.php'; ?>
