<?php
require 'config.php';

$db = new SQLite3(__DIR__ . '/database/panel.db');

function getSetting($db, $key) {
    $stmt = $db->prepare("
        SELECT setting_value
        FROM settings
        WHERE setting_key = :key
        LIMIT 1
    ");
    $stmt->bindValue(':key', $key, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    return $result ? $result['setting_value'] : '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Downloads | TRENZYCH VPN</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="container">

<h1>⬇️ Download Apps</h1>

<p>Download the recommended VPN clients.</p>
<div class="card">

<h2>📱 Android</h2>

<div class="key">
    <h3>Hiddify Next</h3>
    <p>Recommended for VLESS, Trojan, Hysteria2 and TUIC.</p>

    <a class="copy-btn"
       href="https://github.com/hiddify/hiddify-next/releases/latest"
       target="_blank"
       style="display:flex;text-decoration:none;">
       ⬇️ Download
    </a>
</div>

<div class="key">
    <h3>v2rayNG</h3>
    <p>Best client for VLESS, VMess, Trojan and Shadowsocks.</p>

    <a class="copy-btn"
       href="https://github.com/2dust/v2rayNG/releases/latest"
       target="_blank"
       style="display:flex;text-decoration:none;">
       ⬇️ Download
    </a>
</div>

<div class="key">
    <h3>NekoBox for Android</h3>
    <p>Supports VLESS, Trojan, Shadowsocks and Hysteria.</p>

    <a class="copy-btn"
       href="https://github.com/MatsuriDayo/NekoBoxForAndroid/releases/latest"
       target="_blank"
       style="display:flex;text-decoration:none;">
       ⬇️ Download
    </a>
</div>

</div>

<div class="card">

<h2>💻 Windows</h2>

<div class="key">
    <h3>NekoRay</h3>
    <p>Powerful Windows client for Xray protocols.</p>

    <a class="copy-btn"
       href="https://github.com/MatsuriDayo/nekoray/releases/latest"
       target="_blank"
       style="display:flex;text-decoration:none;">
       ⬇️ Download
    </a>
</div>

<div class="key">
    <h3>Hiddify Desktop</h3>
    <p>Official desktop client.</p>

    <a class="copy-btn"
       href="https://github.com/hiddify/hiddify-next/releases/latest"
       target="_blank"
       style="display:flex;text-decoration:none;">
       ⬇️ Download
    </a>
</div>

</div>
<div class="card">

<h2>🍎 iPhone / iPad</h2>

<div class="key">
    <h3>Streisand</h3>
    <p>Recommended free client for VLESS, Trojan and Shadowsocks.</p>

    <a class="copy-btn"
       href="https://apps.apple.com/"
       target="_blank"
       style="display:flex;text-decoration:none;">
       🍎 App Store
    </a>
</div>

</div>

<div class="card">

<h2>📚 Setup Guide</h2>

<div class="key">

<p>Recommended Apps:</p>

<ul style="line-height:2;">
<li>📱 Android → Hiddify Next</li>
<li>💻 Windows → NekoRay</li>
<li>🍎 iPhone → Streisand</li>
</ul>

</div>

</div>

<?php include 'includes/footer.php'; ?>

</div>

</body>
</html>
