<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../admin/login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

$totalKeys = (int)$db->querySingle("SELECT COUNT(*) FROM vpn_keys");
$totalServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers");
$premiumKeys = (int)$db->querySingle("SELECT COUNT(*) FROM vpn_keys WHERE plan='Premium'");
$onlineServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers WHERE status=1");

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">

<div class="card">

<h1>📊 Dashboard</h1>

<p style="color:#94a3b8;margin-top:8px;">
Welcome to TRENZYCH Admin v2
</p>

<div class="grid" style="margin-top:25px;">

<div class="stat-card">
<div style="font-size:42px;">🔑</div>
<h2 style="color:#00e676;"><?php echo $totalKeys; ?></h2>
<p>Total VPN Keys</p>
</div>

<div class="stat-card">
<div style="font-size:42px;">💎</div>
<h2 style="color:#00e676;"><?php echo $premiumKeys; ?></h2>
<p>Premium Keys</p>
</div>

<div class="stat-card">
<div style="font-size:42px;">🖥️</div>
<h2 style="color:#00e676;"><?php echo $totalServers; ?></h2>
<p>Servers</p>
</div>

<div class="stat-card">
<div style="font-size:42px;">🟢</div>
<h2 style="color:#00e676;"><?php echo $onlineServers; ?></h2>
<p>Online Servers</p>
</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>
