<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $stmt = $db->prepare("
    UPDATE vip_plans
SET
country=:country,
flag=:flag,
plan_name=:plan_name,
description=:description,
data_limit=:data_limit,
devices=:devices,
duration=:duration,
price=:price,
badge=:badge,
button_url=:button_url
WHERE id=:id
    (
        country,
        flag,
        plan_name,
        description,
        data_limit,
        devices,
        duration,
        price,
        badge,
        button_url,
        status
    )
    VALUES
    (
        :country,
        :flag,
        :plan_name,
        :description,
        :data_limit,
        :devices,
        :duration,
        :price,
        :badge,
        :button_url,
        1
    )
    ");

    $stmt->bindValue(':country', $_POST['country']);
    $stmt->bindValue(':flag', $_POST['flag']);
    $stmt->bindValue(':plan_name', $_POST['plan_name']);
    $stmt->bindValue(':description', $_POST['description']);
    $stmt->bindValue(':data_limit', $_POST['data_limit']);
    $stmt->bindValue(':devices', $_POST['devices']);
    $stmt->bindValue(':duration', $_POST['duration']);
    $stmt->bindValue(':price', $_POST['price']);
    $stmt->bindValue(':badge', $_POST['badge']);
    $stmt->bindValue(':button_url', $_POST['button_url']);$stmt->bindValue(':id', $_POST['id'], SQLITE3_INTEGER);

    $stmt->execute();

    header("Location: vip-plans.php");
    exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add VIP Plan</title>

<style>
body{
    margin:0;
    background:#0f172a;
    color:#fff;
    font-family:Arial,sans-serif;
    padding:30px;
}
.card{
    max-width:700px;
    margin:auto;
    background:#1e293b;
    padding:25px;
    border-radius:15px;
}
input,textarea{
    width:100%;
    padding:12px;
    margin:8px 0 16px;
    border:none;
    border-radius:8px;
    background:#0f172a;
    color:#fff;
    box-sizing:border-box;
}
button{
    width:100%;
    padding:14px;
    background:#00c853;
    color:#fff;
    border:none;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
}
a{
    color:#4fc3f7;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="card">

<h2>💎 Add VIP Plan</h2>

<form method="POST">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<label>Country</label>
<input type="text" name="country" value="<?php echo htmlspecialchars($row['country']); ?>" required>

<label>Flag Emoji</label>
<input type="text" name="flag" value="<?php echo htmlspecialchars($row['flag']); ?>">
<label>Plan Name</label>
<input type="text" name="plan_name" value="<?php echo htmlspecialchars($row['plan_name']); ?>" required>

<label>Description</label>
<textarea name="description"><?php echo htmlspecialchars($row['description']); ?></textarea>

<label>Data Limit</label>
<input type="text" name="data_limit" value="<?php echo htmlspecialchars($row['data_limit']); ?>">

<label>Devices</label>
<input type="text" name="devices" value="<?php echo htmlspecialchars($row['devices']); ?>">

<label>Duration</label>
<input type="text" name="duration" value="<?php echo htmlspecialchars($row['duration']); ?>">

<label>Price</label>
<input type="text" name="price" value="<?php echo htmlspecialchars($row['price']); ?>">

<label>Badge</label>
<input type="text" name="badge" value="<?php echo htmlspecialchars($row['badge']); ?>">

<label>Telegram / Order Link</label>
<input type="text" name="button_url" value="<?php echo htmlspecialchars($row['button_url']); ?>">

<button type="submit">
Save VIP Plan
</button>

</form>

<br>

<a href="vip-plans.php">⬅ Back to VIP Plans</a>

</div>

</body>
</html>
