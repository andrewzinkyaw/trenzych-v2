<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $ip = trim($_POST['ip']);
    $domain = trim($_POST['domain']);

    if ($name !== '' && $ip !== '') {

        $stmt = $db->prepare("
        INSERT INTO servers(name,ip,domain)
        VALUES(:name,:ip,:domain)
        ");

        $stmt->bindValue(':name',$name,SQLITE3_TEXT);
        $stmt->bindValue(':ip',$ip,SQLITE3_TEXT);
        $stmt->bindValue(':domain',$domain,SQLITE3_TEXT);

        $stmt->execute();

        header("Location: servers.php");
        exit;
    }
}

$result = $db->query("
SELECT *
FROM servers
ORDER BY id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Server Manager</title>

<style>

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:#0f172a;
    color:#fff;
}

.container{
    max-width:1100px;
    margin:auto;
    padding:20px;
}

.card{
    background:#1e293b;
    padding:20px;
    border-radius:12px;
    margin-bottom:20px;
}

h2{
    color:#00e676;
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:none;
    border-radius:8px;
    box-sizing:border-box;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#00e676;
    color:#000;
    font-weight:bold;
    cursor:pointer;
}</style>
</head>

<body>

<div class="container">

<div class="card">

<h2>➕ Add Server</h2>

<form method="POST">

<input
type="text"
name="name"
placeholder="Server Name (SG-01)"
required>

<input
type="text"
name="ip"
placeholder="Server IP"
required>

<input
type="text"
name="domain"
placeholder="Domain (Optional)">

<button type="submit">
Add Server
</button>

</form>

</div>

<div class="card">

<h2>🖥 Server List</h2>

<table style="width:100%;border-collapse:collapse;">

<tr>
<th align="left">Name</th>
<th align="left">IP</th>
<th align="left">Domain</th>
</tr>

<?php while($row = $result->fetchArray(SQLITE3_ASSOC)){ ?>

<tr>

<td style="padding:12px 0;">
<?php echo htmlspecialchars($row['name']); ?>
</td>

<td>
<?php echo htmlspecialchars($row['ip']); ?>
</td>

<td>
<?php echo htmlspecialchars($row['domain']); ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>
