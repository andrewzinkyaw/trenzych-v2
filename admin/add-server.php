<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $ip = trim($_POST['ip']);
    $port = (int)($_POST['port'] ?? 443);
    $domain = trim($_POST['domain']);
    $country = trim($_POST['country']);
    $provider = trim($_POST['provider']);
    $remarks = trim($_POST['remarks']);

    if ($name == "" || $ip == "") {

        $error = "Please fill required fields.";

    } else {

        $stmt = $db->prepare("
        INSERT INTO servers
        (
            name,
            ip,
            port,
            domain,
            country,
            provider,
            remarks
        )
        VALUES
        (
            :name,
            :ip,
            :port,
            :domain,
            :country,
            :provider,
            :remarks
        )
        ");

        $stmt->bindValue(':name',$name,SQLITE3_TEXT);
        $stmt->bindValue(':ip',$ip,SQLITE3_TEXT);
        $stmt->bindValue(':port',$port,SQLITE3_INTEGER);
        $stmt->bindValue(':domain',$domain,SQLITE3_TEXT);
        $stmt->bindValue(':country',$country,SQLITE3_TEXT);
        $stmt->bindValue(':provider',$provider,SQLITE3_TEXT);
        $stmt->bindValue(':remarks',$remarks,SQLITE3_TEXT);

        $stmt->execute();

        header("Location: servers.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Add Server</title>

<style>

body{
    margin:0;
    background:#0f172a;
    color:#fff;
    font-family:Arial,sans-serif;
}

.container{
    width:90%;
    max-width:700px;
    margin:40px auto;
}

.card{
    background:#1e293b;
    padding:25px;
    border-radius:14px;
}

h2{
    margin-top:0;
    color:#00e676;
}

label{
    display:block;
    margin-top:15px;
    margin-bottom:6px;
}

input,
textarea{

    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    box-sizing:border-box;
}

textarea{
    min-height:90px;
    resize:vertical;
}

button{

    margin-top:20px;
    width:100%;
    padding:14px;
    border:none;
    border-radius:8px;
    background:#00e676;
    color:#000;
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

<a class="back" href="servers.php">
← Back to Servers
</a>

<div class="card">

<h2>➕ Add Server</h2>

<?php if($error!=""){ ?>
<div class="error">
<?php echo htmlspecialchars($error); ?>
</div>
<?php } ?>

<form method="POST">
<label>Server Name *</label>
<input
type="text"
name="name"
required>

<label>Server IP *</label>
<input
type="text"
name="ip"
required>

<label>Port</label>
<input
type="number"
name="port"
value="443">

<label>Domain</label>
<input
type="text"
name="domain">

<label>Country</label>
<input
type="text"
name="country"
value="Singapore">

<label>Provider</label>
<input
type="text"
name="provider"
placeholder="DigitalOcean">

<label>Remarks</label>
<textarea
name="remarks"></textarea>

<button type="submit">
💾 Save Server
</button>

</form>

</div>

</div>

</body>
</html>
