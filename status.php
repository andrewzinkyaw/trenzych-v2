<?php
require_once 'config.php';

$db = new SQLite3(__DIR__ . '/database/panel.db');

$servers = [];

$result = $db->query("
SELECT
    id,
    name,
    country,
    status,
    ping
FROM servers
ORDER BY name ASC
");

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $servers[] = $row;
}

$totalServers = count($servers);
$onlineServers = 0;

foreach ($servers as $server) {
    if ((int)$server['status'] === 1) {
        $onlineServers++;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Server Status | TRENZYCH VPN</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

body{
    background:#07101d;
}

.status-header{
    padding:80px 20px 40px;
    text-align:center;
}

.status-header h1{
    color:#fff;
    font-size:48px;
    margin-bottom:10px;
}

.status-header p{
    color:#94a3b8;
    font-size:18px;
}

.summary-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:24px;
    margin-top:40px;
}

.summary-card{
    background:rgba(15,23,42,.82);
    border:1px solid rgba(255,255,255,.08);
    border-radius:22px;
    padding:30px;
    text-align:center;
    backdrop-filter:blur(16px);
}

.summary-number{
    font-size:46px;
    font-weight:800;
    color:#00e676;
}

.summary-label{
    color:#cbd5e1;
    margin-top:10px;
}

.server-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:24px;
    margin-top:50px;
}.server-card{
    background:rgba(15,23,42,.82);
    border:1px solid rgba(255,255,255,.08);
    border-radius:22px;
    padding:28px;
    backdrop-filter:blur(16px);
    transition:.3s;
}

.server-card:hover{
    transform:translateY(-6px);
    border-color:#00e676;
    box-shadow:0 0 28px rgba(0,230,118,.18);
}

.server-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
    margin-bottom:22px;
}

.server-name{
    color:#fff;
    font-size:28px;
    margin:0;
}

.server-country{
    color:#94a3b8;
    margin-top:8px;
}

.badge{
    display:inline-block;
    padding:8px 16px;
    border-radius:999px;
    color:#fff;
    font-weight:700;
    font-size:14px;
}

.online{
    background:#00c853;
}

.offline{
    background:#e53935;
}

.server-info{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:16px;
}

.info-box{
    background:rgba(255,255,255,.04);
    border-radius:16px;
    padding:16px;
    text-align:center;
}

.info-title{
    color:#94a3b8;
    font-size:14px;
    margin-bottom:8px;
}

.info-value{
    color:#fff;
    font-size:18px;
    font-weight:700;
}

@media(max-width:768px){

.server-grid{
    grid-template-columns:1fr;
}

.server-info{
    grid-template-columns:1fr;
}

.server-top{
    flex-direction:column;
}

}

</style>

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="container">

<section class="status-header">

<h1>📊 Server Status</h1>

<p>Real-time server availability</p>

<div class="summary-grid">

<div class="summary-card">
<div class="summary-number">
<?php echo $totalServers; ?>
</div>
<div class="summary-label">
Total Servers
</div>
</div>

<div class="summary-card">
<div class="summary-number">
<?php echo $onlineServers; ?>
</div>
<div class="summary-label">
Online
</div>
</div>

<div class="summary-card">
<div class="summary-number">
<?php echo $totalServers - $onlineServers; ?>
</div>
<div class="summary-label">
Offline
</div>
</div>

</div>

</section>

<div class="server-grid"><?php if($totalServers > 0): ?>

<?php foreach($servers as $server): ?>

<div class="server-card">

<div class="server-top">

<div>

<h2 class="server-name">
<?php echo htmlspecialchars($server['name']); ?>
</h2>

<div class="server-country">

<?php

$country = strtoupper(trim($server['country']));

switch($country){

case "SG":
case "SINGAPORE":
echo "🇸🇬 Singapore";
break;

case "JP":
case "JAPAN":
echo "🇯🇵 Japan";
break;

case "US":
case "USA":
case "UNITED STATES":
echo "🇺🇸 United States";
break;

case "DE":
case "GERMANY":
echo "🇩🇪 Germany";
break;

default:
echo "🌍 ".htmlspecialchars($server['country']);

}

?>

</div>

</div>

<div>

<?php if((int)$server['status'] === 1): ?>

<span class="badge online">
🟢 ONLINE
</span>

<?php else: ?>

<span class="badge offline">
🔴 OFFLINE
</span>

<?php endif; ?>

</div>

</div>

<div class="server-info">

<div class="info-box">

<div class="info-title">
Ping
</div>

<div class="info-value">
⚡ <?php echo (int)$server['ping']; ?> ms
</div>

</div>

<div class="info-box">

<div class="info-title">
Status
</div>

<div class="info-value">

<?php
echo ((int)$server['status'] === 1)
? "Available"
: "Unavailable";
?>

</div>

</div>

</div>

</div>

<?php endforeach; ?>

<?php else: ?>

<div class="server-card">

<h2 style="color:#fff;margin-bottom:15px;">
No Servers Available
</h2>

<p style="color:#94a3b8;">
Please add a server from the Admin Panel.
</p>

</div>

<?php endif; ?></div>

</div>

<?php include 'includes/footer.php'; ?>

<script>

setInterval(function(){

    location.reload();

},30000);

</script>

</body>

</html>
