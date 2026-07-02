<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__.'/../database/panel.db');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $db->prepare("SELECT * FROM vpn_keys WHERE id=:id");
$stmt->bindValue(':id',$id,SQLITE3_INTEGER);
$result = $stmt->execute();
$key = $result->fetchArray(SQLITE3_ASSOC);

if(!$key){
    die("Key not found");
}

if($_SERVER['REQUEST_METHOD']=="POST"){

    $name=trim($_POST['name']);
    $type=trim($_POST['type']);
    $config=trim($_POST['config']);

    $stmt=$db->prepare("
    UPDATE vpn_keys
    SET
        name=:name,
        type=:type,
        config=:config
    WHERE id=:id
    ");

    $stmt->bindValue(':name',$name,SQLITE3_TEXT);
    $stmt->bindValue(':type',$type,SQLITE3_TEXT);
    $stmt->bindValue(':config',$config,SQLITE3_TEXT);
    $stmt->bindValue(':id',$id,SQLITE3_INTEGER);
    $stmt->execute();

    header("Location: keys.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Edit VPN Key</title>

<style>
body{
background:#0f172a;
color:#fff;
font-family:Arial,sans-serif;
margin:0;
}
.container{
width:95%;
max-width:700px;
margin:30px auto;
}
.card{
background:#1e293b;
padding:20px;
border-radius:12px;
}
input,select,textarea{
width:100%;
padding:12px;
margin-bottom:12px;
border:none;
border-radius:8px;
box-sizing:border-box;
}
button{
padding:12px 18px;
background:#00e676;
color:#000;
border:none;
border-radius:8px;
font-weight:bold;
cursor:pointer;
}
</style>
</head>
<body>

<div class="container">
<div class="card">

<h2>Edit VPN Key</h2>

<form method="POST">

<input
type="text"
name="name"
value="<?= htmlspecialchars($key['name']) ?>"
required>

PHP<select name="type">
<option value="VLESS" <?= $key['type']=='VLESS'?'selected':'' ?>>VLESS</option>
<option value="Shadowsocks" <?= $key['type']=='Shadowsocks'?'selected':'' ?>>Shadowsocks</option>
<option value="Hysteria" <?= $key['type']=='Hysteria'?'selected':'' ?>>Hysteria</option>
<option value="Trojan" <?= $key['type']=='Trojan'?'selected':'' ?>>Trojan</option>
</select>

<textarea
name="config"
rows="8"
required><?= htmlspecialchars($key['config']) ?></textarea>

<button type="submit">Update Key</button>

</form>

<br>

<a href="keys.php" style="color:#fff;">⬅ Back to Keys</a>

</div>
</div>

</body>
</html>
