<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: servers.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $db->prepare("SELECT * FROM servers WHERE id=:id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$result = $stmt->execute();
$server = $result->fetchArray(SQLITE3_ASSOC);

if (!$server) {
    header("Location: servers.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $ip = trim($_POST['ip']);
    $port = (int)$_POST['port'];
    $domain = trim($_POST['domain']);
    $country = trim($_POST['country']);
    $provider = trim($_POST['provider']);
    $remarks = trim($_POST['remarks']);

    if ($name == "" || $ip == "") {

        $error = "Please fill required fields.";

    } else {

        $update = $db->prepare("
        UPDATE servers
        SET
            name=:name,
            ip=:ip,
            port=:port,
            domain=:domain,
            country=:country,
            provider=:provider,
            remarks=:remarks
        WHERE id=:id
        ");

        $update->bindValue(':name',$name,SQLITE3_TEXT);
        $update->bindValue(':ip',$ip,SQLITE3_TEXT);
        $update->bindValue(':port',$port,SQLITE3_INTEGER);
        $update->bindValue(':domain',$domain,SQLITE3_TEXT);
        $update->bindValue(':country',$country,SQLITE3_TEXT);
        $update->bindValue(':provider',$provider,SQLITE3_TEXT);
        $update->bindValue(':remarks',$remarks,SQLITE3_TEXT);
        $update->bindValue(':id',$id,SQLITE3_INTEGER);

        $update->execute();

        header("Location: servers.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Edit Server</title>

<style>

body{
margin:0;
background:#0f172a;
font-family:Arial,sans-serif;
color:#fff;
}

.container{
max-width:700px;
width:90%;
margin:40px auto;
}

.card{
background:#1e293b;
padding:25px;
border-radius:14px;
}

input,
textarea{
width:100%;
padding:12px;
margin-top:6px;
margin-bottom:15px;
border:none;
border-radius:8px;
box-sizing:border-box;
}

textarea{
min-height:90px;
resize:vertical;
}

button{
width:100%;
padding:14px;
border:none;
border-radius:8px;
background:#00e676;
font-weight:bold;
cursor:pointer;
}

.back{
display:inline-block;
margin-bottom:20px;
color:#00e676;
text-decoration:none;
}

.error{
background:#ef4444;
padding:12px;
border-radius:8px;
margin-bottom:15px;
}

</style>

</head>

<body>

<div class="container">

<a class="back" href="servers.php">← Back to Servers</a>

<div class="card">

<h2>✏ Edit Server</h2>

<?php if($error!=""){ ?>
<div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php } ?>

<form method="POST">
<label>Server Name *</label>
<input
type="text"
name="name"
value="<?php echo htmlspecialchars($server['name']); ?>"
required>

<label>Server IP *</label>
<input
type="text"
name="ip"
value="<?php echo htmlspecialchars($server['ip']); ?>"
required>

<label>Port</label>
<input
type="number"
name="port"
value="<?php echo (int)$server['port']; ?>">

<label>Domain</label>
<input
type="text"
name="domain"
value="<?php echo htmlspecialchars($server['domain']); ?>">

<label>Country</label>
<input
type="text"
name="country"
value="<?php echo htmlspecialchars($server['country']); ?>">

<label>Provider</label>
<input
type="text"
name="provider"
value="<?php echo htmlspecialchars($server['provider']); ?>">

<label>Remarks</label>
<textarea
name="remarks"><?php echo htmlspecialchars($server['remarks']); ?></textarea>

<button type="submit">
💾 Update Server
</button>

</form>

</div>

</div>

</body>
</html>
