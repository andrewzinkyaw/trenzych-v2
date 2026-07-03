<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

$total = 0;
if ($db) {
    $result = $db->query("SELECT COUNT(*) AS total FROM vpn_keys");
    if ($result) {
        $row = $result->fetchArray(SQLITE3_ASSOC);
        $total = $row['total'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
background:#0f172a;
font-family:Arial,sans-serif;
color:#fff;
}

.container{
width:95%;
max-width:1000px;
margin:30px auto;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.logo{
font-size:32px;
color:#00e676;
font-weight:bold;
}

.logout{
background:#ff5252;
color:#fff;
padding:10px 18px;
text-decoration:none;
border-radius:8px;
}

.card{
background:#1e293b;
padding:20px;
border-radius:12px;
margin-bottom:20px;
box-shadow:0 10px 25px rgba(0,0,0,.35);
}

.stat{
font-size:24px;
color:#00e676;
font-weight:bold;
margin-top:10px;
}</style>

</head>
<body>

<div class="container">

<div class="header">
<div class="logo">🚀 TRENZYCH VPN</div>
<a class="logout" href="logout.php">Logout</a>
</div>

<div class="card">
<h2>Dashboard</h2>
<div class="stat">
Total VPN Keys : <?php echo $total; ?>
</div>
</div>

<div class="card">

<h2>VPN Keys</h2>

<table width="100%" cellpadding="10">

<tr>
<th>ID</th>
<th>Name</th>
<th>Type</th>
<th>Created</th>
</tr>

<?php

$result = $db->query("SELECT * FROM vpn_keys ORDER BY id DESC");

while($row = $result->fetchArray(SQLITE3_ASSOC)){

echo "<tr>";

echo "<td>".$row['id']."</td>";

echo "<td>".$row['name']."</td>";

echo "<td>".$row['type']."</td>";

echo "<td>".$row['created_at']."</td>";

echo "</tr>";

}

?>

</table>

</div><div class="card">

<a href="servers.php" style="display:inline-block;padding:12px 18px;background:#00e676;color:#000;text-decoration:none;border-radius:8px;margin-right:10px;">
🖥 Servers
</a>

<a href="keys.php" style="display:inline-block;padding:12px 18px;background:#2196f3;color:#fff;text-decoration:none;border-radius:8px;">
🔑 VPN Keys
</a>

<a href="settings.php" style="display:inline-block;padding:12px 18px;background:#ff9800;color:#fff;text-decoration:none;border-radius:8px;margin-left:10px;">
⚙️ Settings
</a>

</div>

</div>

</body>
</html>
