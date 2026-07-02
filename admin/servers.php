<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

$db->exec("
CREATE TABLE IF NOT EXISTS servers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    ip TEXT,
    domain TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $ip = trim($_POST['ip']);
    $domain = trim($_POST['domain']);

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

$result = $db->query("SELECT * FROM servers ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1"><input
type="text"
name="name"
placeholder="Server Name"
required>

<input
type="text"
name="ip"
placeholder="Server IP"
required>

<input
type="text"
name="domain"
placeholder="Domain"
required>

<button type="submit">
Add Server
</button>

</form>

</div>

<div class="card">

<h2>Server List</h2>

<table>

<tr>

<th>ID</th>
<th>Name</th>
<th>IP</th>
<th>Domain</th>
<th>Created</th>

</tr>

<?php

while($row = $result->fetchArray(SQLITE3_ASSOC)){

echo "<tr>";

echo "<td>".$row['id']."</td>";

echo "<td>".htmlspecialchars($row['name'])."</td>";

echo "<td>".htmlspecialchars($row['ip'])."</td>";

echo "<td>".htmlspecialchars($row['domain'])."</td>";

echo "<td>".$row['created_at']."</td>";

echo "</tr>";

}

?>

</table>

</div><div class="card">

<a href="dashboard.php" style="
display:inline-block;
padding:12px 20px;
background:#2196f3;
color:#fff;
text-decoration:none;
border-radius:8px;
">
⬅ Back to Dashboard
</a>

</div>

</div>

</body>
</html>
