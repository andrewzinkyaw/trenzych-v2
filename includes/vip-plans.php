<?php

$plans = $db->query("
SELECT *
FROM vip_plans
WHERE status=1
ORDER BY featured DESC, sort_order ASC, id DESC
");

?>

<h2 style="
margin-top:40px;
margin-bottom:20px;
font-size:30px;
text-align:center;
color:#fff;
">
🔥 VIP Plans
</h2>

<div class="vip-grid">

<?php
while($plan = $plans->fetchArray(SQLITE3_ASSOC)){
?>

<div class="vip-card">

<h3>
<?php echo htmlspecialchars($plan['flag']." ".$plan['plan_name']); ?>
</h3>

<p>
<?php echo htmlspecialchars($plan['description']); ?>
</p>

</div>

<?php } ?>

</div>

<style>

.vip-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:20px;
margin:25px 0;
}

.vip-card{

background:#1e293b;

border-radius:18px;

padding:20px;

border:1px solid rgba(255,255,255,.08);

}

.vip-card h3{

margin:0 0 10px;

color:#fff;

}

.vip-card p{

color:#94a3b8;

}

</style>
