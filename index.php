<?php
require 'config.php';

$db = new SQLite3(__DIR__ . '/database/panel.db');

$result = $db->query("
SELECT id,name,type,config,created_at,country,plan,featured
FROM vpn_keys
ORDER BY featured DESC, id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TRENZYCH VPN</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>
body{
background:#0f172a;
font-family:Arial,sans-serif;
color:#fff;
margin:0;
}

.container{
width:95%;
max-width:1000px;
margin:30px auto;
}

.header{
text-align:center;
margin-bottom:25px;
}

.card{
background:#1e293b;
border-radius:12px;
padding:20px;
margin-bottom:20px;
box-shadow:0 10px 25px rgba(0,0,0,.35);
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
background:#00e676;
color:#000;
font-weight:bold;
margin-bottom:10px;
}

.copy-btn{
background:#2196f3;
color:#fff;
border:none;
padding:10px 16px;
border-radius:6px;
cursor:pointer;
margin-top:12px;
}
</style>

</head>
<body>

<div class="container">

<div class="header">
<h1>🚀 TRENZYCH VPN</h1>
<p>Fast • Secure • Stable VPN</p>
</div>

<div class="card">
<h2>Available VPN Keys</h2>
<input
type="text"
id="search"
placeholder="Search VPN..."
style="
width:100%;
padding:12px;
margin:15px 0;
border:none;
border-radius:8px;
">

<select
id="filter"
style="
width:100%;
padding:12px;
margin-bottom:20px;
border:none;
border-radius:8px;
">
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
<div class="badge">
<?php echo htmlspecialchars($row['type']); ?>
</div>
<?php if($row['featured']){ ?>
<div style="background:#FFD700;color:#000;padding:5px 10px;border-radius:6px;display:inline-block;font-weight:bold;margin-bottom:8px;">
⭐ FEATURED
</div>
<?php } ?>

<?php if($row['plan']=="Premium"){ ?>
<div style="background:#9C27B0;color:#fff;padding:5px 10px;border-radius:6px;display:inline-block;font-weight:bold;margin-left:6px;margin-bottom:8px;">
💎 PREMIUM
</div>
<?php } else { ?>
<div style="background:#4CAF50;color:#fff;padding:5px 10px;border-radius:6px;display:inline-block;font-weight:bold;margin-left:6px;margin-bottom:8px;">
🆓 FREE
</div>
<?php } ?>
<div style="margin:8px 0;font-size:15px;">
<?php
switch($row['country']){
case "SG":
echo "🇸🇬 Singapore";
break;
case "JP":
echo "🇯🇵 Japan";
break;
case "US":
echo "🇺🇸 United States";
break;
case "DE":
echo "🇩🇪 Germany";
break;
default:
echo "🌍 Unknown";
}
?>
</div>
<h3><?php echo htmlspecialchars($row['name']); ?></h3>

<p>
Created:
<?php echo htmlspecialchars($row['created_at']); ?>
</p>
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
📋 Copy Config
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

</body>
</html>
