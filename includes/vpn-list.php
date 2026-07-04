<?php

$stmt = $db->prepare("
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
WHERE vpn_keys.plan = :plan
ORDER BY vpn_keys.featured DESC, vpn_keys.id DESC
");

$stmt->bindValue(':plan', $plan, SQLITE3_TEXT);

$result = $stmt->execute();

?>
<?php while($row = $result->fetchArray(SQLITE3_ASSOC)){ ?>

<div class="key" data-type="<?php echo htmlspecialchars($row['type']); ?>">

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">

<div>
<?php if($plan == "Premium"){ ?>
<span style="background:#9C27B0;color:#fff;padding:5px 12px;border-radius:999px;font-size:12px;font-weight:700;">
💎 PREMIUM
</span>
<?php } else { ?>
<span style="background:linear-gradient(135deg,#69db5b,#42b84d);color:#fff;padding:5px 12px;border-radius:999px;font-size:12px;font-weight:700;">
FREE
</span>
<?php } ?>
</div>

<div>
<?php if($row['status']){ ?>
<span style="color:#00e676;font-weight:bold;">🟢 ONLINE</span>
<?php } else { ?>
<span style="color:#ff5252;font-weight:bold;">🔴 OFFLINE</span>
<?php } ?>
</div>

</div>

<div style="display:flex;justify-content:space-between;margin-bottom:10px;">

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

<h3 style="text-align:center;font-size:34px;font-weight:800;">
<?php echo htmlspecialchars($row['name']); ?>
</h3>

<p style="text-align:center;color:#94a3b8;">
<?php echo htmlspecialchars($row['type']); ?>
</p><div style="
background:#111827;
color:#00ff99;
padding:12px;
margin:12px 0;
border-radius:10px;
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
📋 COPY CONFIG
</button>

</div>

<?php } ?>

<?php if($result->numColumns() == 0){ ?>

<div class="card" style="text-align:center;padding:40px;">
<h2>No <?php echo htmlspecialchars($plan); ?> VPN Available</h2>
<p>Please check back later.</p>
</div>

<?php } ?><script>
const search = document.getElementById("search");
const filter = document.getElementById("filter");

function updateKeys() {

    const keyword = search ? search.value.toLowerCase() : "";
    const type = filter ? filter.value : "ALL";

    document.querySelectorAll(".key").forEach(card => {

        const text = card.innerText.toLowerCase();
        const keyType = card.dataset.type;

        const matchText = text.includes(keyword);
        const matchType = (type === "ALL" || keyType === type);

        card.style.display = (matchText && matchType)
            ? "block"
            : "none";

    });

}

if(search){
    search.addEventListener("input", updateKeys);
}

if(filter){
    filter.addEventListener("change", updateKeys);
}

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
