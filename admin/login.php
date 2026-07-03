<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';

if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if ($username === "admin" && $password === "MS7LUCKYMAN") {

        $_SESSION["admin"] = $username;
        header("Location: dashboard.php");
        exit;

    } else {

        $error = "Invalid username or password.";

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title><style>
body{
    margin:0;
    font-family:Arial,sans-serif;
    background:#0f172a;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    color:#fff;
}
.login-box{
    width:360px;
    background:#1e293b;
    padding:30px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,.4);
}
h2{
    text-align:center;
    margin-bottom:20px;
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
}
.error{
    color:#ff6b6b;
    text-align:center;
    margin-bottom:10px;
}
</style>
</head>
<body>

<div class="login-box">

<h2>TRENZYCH VPN</h2>

<?php if($error!=""){ ?>
<div class="error"><?=$error?></div>
<?php } ?>

<form method="POST">

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button type="submit">
Login
</button>

</form>

</div>

</body>
</html>
