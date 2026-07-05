<?php
require_once 'config.php';

$db = new SQLite3(__DIR__ . '/database/panel.db');

$totalServers = (int)$db->querySingle("SELECT COUNT(*) FROM servers");

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
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Server Status | TRENZYCH VPN</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

.status-hero{
    padding:80px 20px 40px;
    text-align:center;
}

.status-hero h1{
    font-size:44px;
    color:#fff;
    margin-bottom:12px;
}

.status-hero p{
    color:#94a3b8;
    font-size:18px;
}

.summary-card{
    max-width:280px;
    margin:35px auto;
    background:rgba(15,23,42,.82);
    border:1px solid rgba(255,255,255,.08);
    border-radius:24px;
    padding:28px;
    text-align:center;
    backdrop-filter:blur(18px);
    box-shadow:0 10px 30px rgba(0,0,0,.35);
}

.summary-icon{
    font-size:52px;
    margin-bottom:12px;
}

.summary-number{
    font-size:42px;
    font-weight:800;
    color:#00e676;
}

.summary-label{
    color:#cbd5e1;
    margin-top:8px;
}

.server-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:24px;
    padding:20px;
}

.server-card{
    background:rgba(15,23,42,.82);
    border:1px solid rgba(255,255,255,.08);
    border-radius:24px;
    padding:28px;
    transition:.3s;
    backdrop-filter:blur(18px);
    box-shadow:0 10px 30px rgba(0,0,0,.35);
}

.server-card:hover{
    transform:translateY(-8px);
    border-color:#00e676;
    box-shadow:0 0 30px rgba(0,230,118,.25);
}

.server-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.server-name{
    color:#fff;
    font-size:30px;
    margin:0;
}

.server-country{
    color:#94a3b8;
    margin-top:8px;
}

.status-online,
.status-offline{
    padding:8px 16px;
    border-radius:999px;
    color:#fff;
    font-weight:700;
}

.status-online{
    background:#00c853;
}

.status-offline{
    background:#e53935;
}

.server-ping{
    margin-top:18px;
    font-size:18px;
    color:#cbd5e1;
}

</style>

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<section class="status-hero">

<h1>📊 Server Status</h1>

<p>Real-time server availability</p>

<div class="summary-card">

<div class="summary-icon">🖥️</div>

<div class="summary-number">
<?php echo $totalServers; ?>
</div>

<div class="summary-label">
Servers Online
</div>

</div>

<div class="server-grid">
<?php while($row = $result->fetchArray(SQLITE3_ASSOC)): ?>

<div class="card server-card">

<div class="server-top">

<div>

<h2 class="server-name">
<?php echo htmlspecialchars($row['name']); ?>
</h2>

<div class="server-country">

<?php
switch(strtoupper($row['country'])){

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
echo "🇺🇸 United States";
break;

case "DE":
case "GERMANY":
echo "🇩🇪 Germany";
break;

default:
echo "🌍 ".htmlspecialchars($row['country']);
}
?>

</div>

</div>

<div>

<?php if((int)$row['status'] === 1): ?>

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
⚡ <?php echo (int)$row['ping']; ?> ms
</div>

</div>

<div class="info-box">

<div class="info-title">
Status
</div>

<div class="info-value">

<?php
echo ((int)$row['status'] === 1)
? "Available"
: "Unavailable";
?>

</div>

</div>

</div>

</div>

<?php endwhile; ?>

<?php if($totalServers == 0): ?>

<div class="card empty-card">

<h2>No Servers Found</h2>

<p>
Please add your first server from the Admin Panel.
</p>

</div>

<?php endif; ?>
</div>
</section>

<?php include 'includes/footer.php'; ?>

<script>
setTimeout(function(){
    location.reload();
},30000);
</script>

</body>
</html>
