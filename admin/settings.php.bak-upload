<?php
require_once '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = new SQLite3(__DIR__ . '/../database/panel.db');

function getSetting($db, $key) {
    $stmt = $db->prepare("SELECT setting_value FROM settings WHERE setting_key = :key LIMIT 1");
    $stmt->bindValue(':key', $key, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    return $result ? $result['setting_value'] : '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $settings = [
        'site_name',
        'telegram_url',
        'footer_text',
        'theme_color'
    ];

    foreach ($settings as $key) {

        $value = trim($_POST[$key] ?? '');

        $stmt = $db->prepare("
            UPDATE settings
            SET setting_value = :value,
                updated_at = CURRENT_TIMESTAMP
            WHERE setting_key = :key
        ");

        $stmt->bindValue(':value', $value, SQLITE3_TEXT);
        $stmt->bindValue(':key', $key, SQLITE3_TEXT);
        $stmt->execute();
    }

    $success = "Settings saved successfully.";
}
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Settings</title>

<style>

body{
    margin:0;
    padding:30px;
    background:#0f172a;
    color:#fff;
    font-family:Arial,sans-serif;
}

.container{
    max-width:700px;
    margin:auto;
}

.card{
    background:#1e293b;
    border-radius:18px;
    padding:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.35);
}

h2{
    margin-top:0;
    margin-bottom:25px;
    font-size:28px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
}

input{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    background:#0f172a;
    color:#fff;
    font-size:15px;
    margin-bottom:20px;
    box-sizing:border-box;
}

button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:14px;
    background:#00c853;
    color:#fff;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#00b248;
}

.success{
    background:#00c85333;
    border:1px solid #00e676;
    padding:12px;
    border-radius:10px;
    margin-bottom:20px;
}

</style>

</head>
<body>

<div class="container">

<div class="card">

<h2>⚙️ Panel Settings</h2>

<?php if(isset($success)){ ?>
<div class="success">
<?php echo $success; ?>
</div>
<?php } ?>

<form method="POST">

<label>Website Name</label>
<input
type="text"
name="site_name"
value="<?php echo htmlspecialchars(getSetting($db,'site_name')); ?>"
>

<label>Telegram Link</label>
<input
type="text"
name="telegram_url"
value="<?php echo htmlspecialchars(getSetting($db,'telegram_url')); ?>"
>

<label>Footer Text</label>
<input
type="text"
name="footer_text"
value="<?php echo htmlspecialchars(getSetting($db,'footer_text')); ?>"
>

<label>Theme Color</label>
<input
type="text"
name="theme_color"
value="<?php echo htmlspecialchars(getSetting($db,'theme_color')); ?>"
>

<button type="submit">
💾 Save Settings
</button>

</form>

</div>

</div>

</body>
</html>
