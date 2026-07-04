<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VIP Plans</title>

<style>
body{
    margin:0;
    background:#0f172a;
    color:#fff;
    font-family:Arial,sans-serif;
    padding:30px;
}

.card{
    background:#1e293b;
    border-radius:12px;
    padding:20px;
    max-width:1200px;
    margin:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th,td{
    padding:12px;
    border-bottom:1px solid #334155;
}

th{
    color:#4fc3f7;
}

.btn{
    background:#2196f3;
    color:#fff;
    padding:10px 18px;
    text-decoration:none;
    border-radius:8px;
}

.btn-add{
    background:#00c853;
}
</style>

</head>
<body>

<div class="card">

<h2>💎 VIP Plans</h2>

<a class="btn btn-add" href="vip-plan-add.php">
+ Add New Plan
</a>

<table>

<tr>
<th>ID</th>
<th>Country</th>
<th>Plan</th>
<th>Price</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php

$result=$db->query("
SELECT *
FROM vip_plans
ORDER BY sort_order,id
");

while($row=$result->fetchArray(SQLITE3_ASSOC))
{

echo "<tr>";

echo "<td>".$row['id']."</td>";

echo "<td>".$row['flag']." ".$row['country']."</td>";

echo "<td>".$row['plan_name']."</td>";

echo "<td>".$row['price']."</td>";

echo "<td>".($row['status'] ? "🟢 Active" : "🔴 Hidden")."</td>";

echo "<td>
<a href='vip-plan-edit.php?id=".$row['id']."' style='color:#4fc3f7;'>✏ Edit</a>
 |
<a href='vip-plan-delete.php?id=".$row['id']."' style='color:#ff5252;' onclick=\"return confirm('Delete this plan?')\">🗑 Delete</a>
</td>";

echo "</tr>";

}

?>

</table>

<br>

<a class="btn" href="dashboard.php">
⬅ Back to Dashboard
</a>

</div>

</body>
</html>
