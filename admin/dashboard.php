<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

$totalKeys = (int)$db->querySingle("SELECT COUNT(*) FROM vpn_keys");
$totalServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers");
$onlineServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers WHERE status=1");
$premiumKeys = (int)$db->querySingle("SELECT COUNT(*) FROM vpn_keys WHERE plan='Premium'");

$recentKeys = $db->query("
SELECT id,name,type,plan,created_at
FROM vpn_keys
ORDER BY id DESC
LIMIT 5
");

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">

<div class="card">

<h1 style="margin-bottom:10px;">📊 Dashboard</h1>

<p style="color:#94a3b8;">
Welcome to TRENZYCH VPN Admin Panel
</p>

<div style="
display:grid;
grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
gap:18px;
margin-top:25px;
">

<div class="card" style="text-align:center;">
<div style="font-size:42px;">🔑</div>
<h2 style="color:#00e676;"><?php echo $totalKeys; ?></h2>
<p>Total VPN Keys</p>
</div>

<div class="card" style="text-align:center;">
<div style="font-size:42px;">💎</div>
<h2 style="color:#00e676;"><?php echo $premiumKeys; ?></h2>
<p>Premium Keys</p>
</div>

<div class="card" style="text-align:center;">
<div style="font-size:42px;">🖥️</div>
<h2 style="color:#00e676;"><?php echo $totalServers; ?></h2>
<p>Servers</p>
</div>

<div class="card" style="text-align:center;">
<div style="font-size:42px;">🟢</div>
<h2 style="color:#00e676;"><?php echo $onlineServers; ?></h2>
<p>Online Servers</p>
</div>

</div>

</div><div class="card">

<h2 style="margin-bottom:20px;">⚡ Quick Actions</h2>

<div style="
display:grid;
grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
gap:18px;
">

<a href="servers.php" class="card" style="
text-decoration:none;
color:#fff;
text-align:center;
">
<div style="font-size:40px;">🖥️</div>
<h3>Servers</h3>
<p style="color:#94a3b8;">Manage VPS Servers</p>
</a>

<a href="keys.php" class="card" style="
text-decoration:none;
color:#fff;
text-align:center;
">
<div style="font-size:40px;">🔑</div>
<h3>VPN Keys</h3>
<p style="color:#94a3b8;">Manage VPN Configs</p>
</a>

<a href="vip-plans.php" class="card" style="
text-decoration:none;
color:#fff;
text-align:center;
">
<div style="font-size:40px;">💎</div>
<h3>VIP Plans</h3>
<p style="color:#94a3b8;">Premium Plans</p>
</a>

<a href="settings.php" class="card" style="
text-decoration:none;
color:#fff;
text-align:center;
">
<div style="font-size:40px;">⚙️</div>
<h3>Settings</h3>
<p style="color:#94a3b8;">Website Settings</p>
</a>

</div>

</div>

<div class="card">

<h2 style="margin-bottom:20px;">🕒 Recent VPN Keys</h2>

<table width="100%" cellpadding="12" style="border-collapse:collapse;">

<tr style="background:#111827;">
<th align="left">ID</th>
<th align="left">Name</th>
<th align="left">Type</th>
<th align="left">Plan</th>
<th align="left">Created</th>
</tr><?php
while($row = $recentKeys->fetchArray(SQLITE3_ASSOC)){
?>

<tr style="border-bottom:1px solid #334155;">

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['type']); ?></td>

<td>

<?php if($row['plan']=="Premium"){ ?>

<span style="
background:#9C27B0;
padding:4px 10px;
border-radius:999px;
font-size:12px;
">
💎 Premium
</span>

<?php } else { ?>

<span style="
background:#00c853;
padding:4px 10px;
border-radius:999px;
font-size:12px;
color:#fff;
">
FREE
</span>

<?php } ?>

</td>

<td><?php echo htmlspecialchars($row['created_at']); ?></td>

</tr>

<?php
}
?>

</table>

</div><?php include 'includes/footer.php'; ?>
