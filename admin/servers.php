<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

$search = trim($_GET['search'] ?? '');

if ($search !== '') {

    $stmt = $db->prepare("
        SELECT *
        FROM servers
        WHERE
            name LIKE :q
            OR ip LIKE :q
            OR domain LIKE :q
            OR provider LIKE :q
        ORDER BY id DESC
    ");

    $stmt->bindValue(':q', "%{$search}%", SQLITE3_TEXT);

    $result = $stmt->execute();

} else {

    $result = $db->query("
        SELECT *
        FROM servers
        ORDER BY id DESC
    ");

}
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
<div style="margin-bottom:20px;">
    <a href="add-server.php"
       style="display:inline-block;
              background:#00e676;
              color:#000;
              padding:12px 18px;
              text-decoration:none;
              border-radius:8px;
              font-weight:bold;">
        ➕ Add Server
    </a>
</div>

<h2>🖥 Server List</h2>
<form method="GET" style="margin:15px 0 20px;">
    <input
        type="text"
        name="search"
        placeholder="🔍 Search by name, IP, domain or provider..."
        value="<?php echo htmlspecialchars($search); ?>"
        style="
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            box-sizing:border-box;
        ">
</form>

<table style="width:100%;border-collapse:collapse;">

<tr>
<th align="left">Name</th>
<th align="left">IP</th>
<th align="left">Domain</th>
<th align="left">Provider</th>
<th align="left">Status</th>
<th align="left">Ping</th>
<th align="center">Action</th>
</tr>

<?php while($row = $result->fetchArray(SQLITE3_ASSOC)){ ?>

<tr>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['ip']); ?></td>

<td><?php echo htmlspecialchars($row['domain']); ?></td>

<td><?php echo htmlspecialchars($row['provider']); ?></td>

<td>
<?php echo $row['status'] ? "🟢 Online" : "🔴 Offline"; ?>
</td>

<td>
<?php echo (int)$row['ping']; ?> ms
</td>

<td align="center">

<a href="edit-server.php?id=<?php echo $row['id']; ?>">
✏️
</a>

&nbsp;

<a
href="delete-server.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this server?');">
🗑
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>
