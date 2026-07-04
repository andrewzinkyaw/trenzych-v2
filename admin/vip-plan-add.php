<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $stmt = $db->prepare("
    INSERT INTO vip_plans
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
    $stmt->bindValue(':button_url', $_POST['button_url']);

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

<label>Country</label>
<input type="text" name="country" placeholder="Singapore" required>

<label>Flag Emoji</label>
<input type="text" name="flag" placeholder="🇸🇬">

<label>Plan Name</label>
<input type="text" name="plan_name" placeholder="Singapore VIP" required>

<label>Description</label>
<textarea name="description"></textarea>

<label>Data Limit</label>
<input type="text" name="data_limit" placeholder="50 GB">

<label>Devices</label>
<input type="text" name="devices" placeholder="1 or 2 Devices">

<label>Duration</label>
<input type="text" name="duration" placeholder="1 Month">

<label>Price</label>
<input type="text" name="price" placeholder="2000 Ks">

<label>Badge</label>
<input type="text" name="badge" placeholder="VIP">

<label>Telegram / Order Link</label>
<input type="text" name="button_url">

<button type="submit">
Save VIP Plan
</button>

</form>

<br>

<a href="vip-plans.php">⬅ Back to VIP Plans</a>

</div>

</body>
</html>
