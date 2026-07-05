<?php

$db = new SQLite3(__DIR__ . '/database/panel.db');

$result = $db->query("SELECT id, ip FROM servers");

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

    $id = (int)$row['id'];
    $ip = escapeshellarg($row['ip']);

    $output = shell_exec("ping -c 1 -W 1 $ip 2>/dev/null");

    $status = 0;
    $ping = 0;

    if ($output && preg_match('/time=([0-9.]+)/', $output, $m)) {

        $status = 1;
        $ping = (int)round($m[1]);

    }

    $stmt = $db->prepare("
        UPDATE servers
        SET status = :status,
            ping = :ping
        WHERE id = :id
    ");

    $stmt->bindValue(':status', $status, SQLITE3_INTEGER);
    $stmt->bindValue(':ping', $ping, SQLITE3_INTEGER);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
}

echo "Done\n";
