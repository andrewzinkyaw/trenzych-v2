<?php
require 'config.php';

$db = new SQLite3(__DIR__ . '/database/panel.db');

$result = $db->query("
SELECT
id,
name,
country,
status,
ping
FROM servers
ORDER BY name ASC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Server Status | TRENZYCH VPN</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="container">

<h1>📊 Server Status</h1>

<p>Real-time server availability</p>
<?php while($row = $result->fetchArray(SQLITE3_ASSOC)): ?>

<div class="card" style="margin-bottom:20px;">

    <div style="display:flex;justify-content:space-between;align-items:center;">

        <div>
            <h2 style="margin:0;">
                <?php echo htmlspecialchars($row['name']); ?>
            </h2>

            <p style="color:#94a3b8;margin:8px 0 0;">
                <?php
                switch($row['country']){
                    case "SG": echo "🇸🇬 Singapore"; break;
                    case "JP": echo "🇯🇵 Japan"; break;
                    case "US": echo "🇺🇸 United States"; break;
                    case "DE": echo "🇩🇪 Germany"; break;
                    default: echo "🌍 Unknown";
                }
                ?>
            </p>
        </div>

        <div style="text-align:right;">

            <?php if($row['status']){ ?>

                <span style="
                display:inline-block;
                padding:6px 12px;
                border-radius:999px;
                background:#00c853;
                color:#fff;
                font-weight:bold;">
                🟢 ONLINE
                </span>

            <?php } else { ?>

                <span style="
                display:inline-block;
                padding:6px 12px;
                border-radius:999px;
                background:#e53935;
                color:#fff;
                font-weight:bold;">
                🔴 OFFLINE
                </span>

            <?php } ?>

            <div style="margin-top:10px;font-weight:bold;">
                ⚡ <?php echo (int)$row['ping']; ?> ms
            </div>

        </div>

    </div>

</div>

<?php endwhile; ?><?php if($result->numColumns() == 0){ ?>

<div class="card" style="text-align:center;padding:40px;">
    <h2>No Servers Available</h2>
    <p>Please add a server from the Admin Panel.</p>
</div>

<?php } ?>

</div>

<script>
// Auto refresh every 30 seconds
setTimeout(function(){
    location.reload();
}, 30000);
</script>

<?php include 'includes/footer.php'; ?>

</body>
</html>
