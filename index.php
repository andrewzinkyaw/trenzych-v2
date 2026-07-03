<?php
require 'config.php';

$db = new SQLite3(__DIR__ . '/database/panel.db');
$totalKeys = $db->querySingle("SELECT COUNT(*) FROM vpn_keys");
$totalServers = $db->querySingle("SELECT COUNT(*) FROM servers");
$onlineServers = $db->querySingle("SELECT COUNT(*) FROM servers WHERE status=1");
$avgPing = (int)$db->querySingle("SELECT AVG(ping) FROM servers");
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
$result = $db->query("
SELECT
vpn_keys.id,
vpn_keys.name,
vpn_keys.type,
vpn_keys.config,
vpn_keys.created_at,
vpn_keys.country,
vpn_keys.plan,
vpn_keys.featured,
servers.name AS server_name,
servers.status,
servers.ping
FROM vpn_keys
LEFT JOIN servers
ON vpn_keys.server_id = servers.id
ORDER BY vpn_keys.featured DESC, vpn_keys.id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars(getSetting($db, 'site_name')); ?></title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

:root{
    --theme-color: <?php echo htmlspecialchars(getSetting($db, 'theme_color')); ?>;
}

body{
    margin:0;
    color:#fff;
    font-family:Arial,sans-serif;

    background:
    radial-gradient(circle at top right, rgba(0,230,118,.12), transparent 35%),
    radial-gradient(circle at bottom left, rgba(59,130,246,.10), transparent 40%),
    linear-gradient(180deg,#0b1220 0%,#0f172a 45%,#111827 100%);

    background-attachment:fixed;
}

.container{
width:95%;
max-width:1000px;
margin:30px auto;
}

.header{
    text-align:center;
    margin-bottom:30px;
    padding:35px 20px;

    background:rgba(30,41,59,.55);
    backdrop-filter:blur(16px);
    -webkit-backdrop-filter:blur(16px);

    border:1px solid rgba(255,255,255,.08);
    border-radius:24px;

    box-shadow:
        0 20px 50px rgba(0,0,0,.35),
        0 0 30px rgba(0,230,118,.08);
}

.card{
    background:rgba(30,41,59,.75);
    backdrop-filter:blur(14px);
    -webkit-backdrop-filter:blur(14px);

    border:1px solid rgba(255,255,255,.08);
    border-radius:18px;

    padding:24px;
    margin-bottom:20px;

    box-shadow:
        0 10px 35px rgba(0,0,0,.45),
        0 0 0 1px rgba(0,230,118,.08);

    transition:.25s ease;
}

.card:hover{
    transform:translateY(-4px);

    box-shadow:
        0 18px 45px rgba(0,0,0,.5),
        0 0 20px rgba(0,230,118,.18);
}

.search-box,
.filter-box{
    width:100%;
    padding:14px 16px;
    margin:15px 0;
    border:1px solid #334155;
    border-radius:14px;
    background:#111827;
    color:#ffffff;
    font-size:15px;
    outline:none;
    transition:.25s ease;
}

.search-box::placeholder{
    color:#94a3b8;
}

.search-box:focus,
.filter-box:focus{
    border-color:var(--theme-color);
    box-shadow:0 0 12px rgba(0,230,118,.25);
}

.filter-box{
    cursor:pointer;
}

.key{
background:#111827;
border-radius:10px;
padding:15px;
margin-top:15px;
}

.badge{
display:inline-block;
padding:5px 10px;
border-radius:5px;
background:var(--theme-color);
color:#000;
font-weight:bold;
margin-bottom:10px;
}

.copy-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    width:100%;
    margin-top:18px;
    padding:15px 20px;
    border:none;
    border-radius:16px;
    cursor:pointer;
    background:linear-gradient(135deg,#00e676,#00c853);
    color:#fff;
    font-size:16px;
    font-weight:700;
    letter-spacing:.4px;
    box-shadow:0 8px 24px rgba(0,230,118,.30);
    transition:.25s ease;
}

.copy-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 28px rgba(0,230,118,.45);
    filter:brightness(1.05);
}
.telegram-btn{
    position:fixed;
    right:20px;
    bottom:20px;
    background:#229ED9;
    color:#fff;
    text-decoration:none;
    padding:12px 18px;
    border-radius:999px;
    font-weight:700;
    font-size:15px;
    box-shadow:0 8px 25px rgba(34,158,217,.4);
    z-index:9999;
    transition:.25s ease;
}

.telegram-btn:hover{
    background:#1b8cc7;
    transform:translateY(-2px);
}
</style>

</head>
<body>

<div class="container">

<div class="header">
    <div style="font-size:52px;margin-bottom:10px;">🚀</div>

    <h1 style="font-size:36px;font-weight:800;color:#fff;">
        <?php echo htmlspecialchars(getSetting($db, 'site_name')); ?>
    </h1>

    <p style="color:#94a3b8;margin-top:10px;">
        Premium High Speed VPN Configurations
    </p>

    <div style="margin-top:18px;">
        <span style="
            background:var(--theme-color);
            color:#08111f;
            padding:8px 18px;
            border-radius:50px;
            font-weight:bold;
        ">
            ⚡ Fast • Secure • Stable
        </span>
</div>

<div style="
display:grid;
grid-template-columns:repeat(2,1fr);
gap:15px;
margin:20px 0;
">

<!-- VPN Keys -->
<div style="
background:rgba(30,41,59,.8);
border:1px solid rgba(255,255,255,.08);
border-radius:16px;
padding:18px;
text-align:center;
">
<div style="font-size:28px;">🔑</div>
<div style="font-size:28px;font-weight:bold;color:var(--theme-color);">
<?php echo $totalKeys; ?>
</div>
<div style="color:#94a3b8;">VPN Keys</div>
</div>

<!-- Servers -->
<div style="
background:rgba(30,41,59,.8);
border:1px solid rgba(255,255,255,.08);
border-radius:16px;
padding:18px;
text-align:center;
">
<div style="font-size:28px;">🖥️</div>
<div style="font-size:28px;font-weight:bold;color:#4fc3f7;">
<?php echo $totalServers; ?>
</div>
<div style="color:#94a3b8;">Servers</div>
</div>

<!-- Online -->
<div style="
background:rgba(30,41,59,.8);
border:1px solid rgba(255,255,255,.08);
border-radius:16px;
padding:18px;
text-align:center;
">
<div style="font-size:28px;">🟢</div>
<div style="font-size:28px;font-weight:bold;color:var(--theme-color)">
<?php echo $onlineServers; ?>
</div>
<div style="color:#94a3b8;">Online</div>
</div>

<!-- Avg Ping -->
<div style="
background:rgba(30,41,59,.8);
border:1px solid rgba(255,255,255,.08);
border-radius:16px;
padding:18px;
text-align:center;
">
<div style="font-size:28px;">⚡</div>
<div style="font-size:28px;font-weight:bold;color:#ffb300;">
<?php echo $avgPing; ?> ms
</div>
<div style="color:#94a3b8;">Avg Ping</div>
</div>

</div>

<h2>Available VPN Keys</h2>
<input
type="text"
id="search"
class="search-box"
placeholder="🔍 Search VPN..."
>

<select
id="filter"
class="filter-box">

<option value="ALL">All Types</option>
<option value="VLESS">VLESS</option>
<option value="Shadowsocks">Shadowsocks</option>
<option value="Hysteria">Hysteria</option>
<option value="Trojan">Trojan</option>
</select>

<?php
while($row = $result->fetchArray(SQLITE3_ASSOC)){
?>

<div class="key" data-type="<?php echo htmlspecialchars($row['type']); ?>">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">

<div>
<?php if($row['plan']=="Premium"){ ?>
<span style="background:#9C27B0;color:#fff;padding:5px 10px;border-radius:999px;font-size:12px;">💎 PREMIUM</span>
<?php } else { ?>
<span style="background:linear-gradient(135deg,#69db5b,#42b84d);color:#fff;padding:4px 14px;border-radius:999px;font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;box-shadow:0 4px 12px rgba(66,184,77,.35);">FREE</span>
<?php } ?>
</div>

<div>
<?php if($row['status']){ ?>
<span style="display:flex;align-items:center;gap:6px;color:#fff !important;font-size:12px;font-weight:600;letter-spacing:.3px;">
    <span style="width:8px;height:8px;border-radius:50%;background:#00e676;box-shadow:0 0 6px rgba(0,230,118,.7);display:inline-block;"></span>
    ONLINE
</span>
<?php } else { ?>
<span style="display:flex;align-items:center;gap:6px;color:#ff5252;font-size:12px;font-weight:600;letter-spacing:.3px;">
    <span style="width:8px;height:8px;border-radius:50%;background:#ff5252;box-shadow:0 0 6px rgba(255,82,82,.7);display:inline-block;"></span>
    OFFLINE
</span>
<?php } ?>
</div>

</div>

<div style="display:flex;justify-content:space-between;margin-bottom:10px;font-size:15px;">
<span>
<?php
switch($row['country']){
case "SG": echo "🇸🇬 Singapore"; break;
case "JP": echo "🇯🇵 Japan"; break;
case "US": echo "🇺🇸 United States"; break;
default: echo "🌍 Unknown";
}
?>
</span>

<span>⚡ <?php echo (int)$row['ping']; ?> ms</span>
</div>

<h3 style="
font-size:30px;
font-weight:800;
color:#f8fafc;
letter-spacing:-0.5px;
margin:12px 0 6px;
line-height:1.2;
text-align:center;
text-shadow:0 2px 10px rgba(255,255,255,.08);
">
<?php echo htmlspecialchars($row['name']); ?>
</h3>

<div style="
font-size:15px;
color:#94a3b8;
margin-bottom:14px;
letter-spacing:.5px;
">
<?php echo htmlspecialchars($row['type']); ?>
</div>

<div style="margin-bottom:10px;line-height:1.7;">
<?php if($row['status']==1){ ?>

<span style="
display:inline-block;
padding:4px 10px;
border-radius:999px;
background:rgba(0,230,118,.15);
color:#00e676;
font-weight:bold;
">
🟢 Active
</span>

<?php } else { ?>

<span style="
display:inline-block;
padding:4px 10px;
border-radius:999px;
background:rgba(255,77,79,.15);
color:#ff4d4f;
font-weight:bold;
">
🔴 Offline
</span>

<?php } ?>

&nbsp;&nbsp;

<?php
$ping = (int)$row['ping'];

if ($ping <= 50) {
    $pingColor = "#00e676";
} elseif ($ping <= 100) {
    $pingColor = "#ffca28";
} else {
    $pingColor = "#ff5252";
}
?>

</div>
<div style="
background:#111827;
color:#00ff99;
padding:12px;
margin:10px 0;
border-radius:8px;
font-family:monospace;
font-size:13px;
word-break:break-all;
border:1px solid #334155;
">
<?php echo htmlspecialchars($row['config']); ?>

</div>
<button
class="copy-btn"
onclick='navigator.clipboard.writeText(<?php echo json_encode($row["config"]); ?>);alert("VPN Config Copied!");'>
<span style="display:flex;align-items:center;justify-content:center;gap:10px;">
<span style="font-size:20px;">📋</span>
<span style="font-weight:700;letter-spacing:.3px;">COPY CONFIG</span>
</span>
</button>

</div>

<?php
}

if($result->numColumns() == 0){
?>
<p>No VPN Keys Available.</p>
<?php
}
?>

</div>
...

</div>

<script>
const search = document.getElementById("search");
const filter = document.getElementById("filter");

function updateKeys() {
    const keyword = search.value.toLowerCase();
    const type = filter.value;

    document.querySelectorAll(".key").forEach(card => {
        const text = card.innerText.toLowerCase();
        const keyType = card.dataset.type;

        const matchText = text.includes(keyword);
        const matchType = (type === "ALL" || keyType === type);

        card.style.display = (matchText && matchType) ? "block" : "none";
    });
}

search.addEventListener("input", updateKeys);
filter.addEventListener("change", updateKeys);
</script>

<script>
document.querySelectorAll(".copy-btn").forEach(btn=>{
    btn.addEventListener("click",function(){
        const old=this.innerHTML;

        this.innerHTML="✅ Copied!";
        this.style.background="#00c853";

        setTimeout(()=>{
            this.innerHTML=old;
            this.style.background="";
        },1500);
    });
});
</script>

<a href="<?php echo htmlspecialchars(getSetting($db, 'telegram_url')); ?>" class="telegram-btn" target="_blank">
 Telegram
</a>

<footer style="
text-align:center;
padding:20px;
color:#94a3b8;
font-size:14px;
margin-top:20px;
">
<?php echo htmlspecialchars(getSetting($db, 'footer_text')); ?>
</footer>

</body>
</html>
