<?php
require_once 'config.php';

header('Content-Type: text/html; charset=UTF-8');

// Basic Auth protection
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_PW'] !== $HEALTH_PASSWORD) {
    header('WWW-Authenticate: Basic realm="Protected"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Unauthorized';
    exit;
}

// Check bot status
$ch = curl_init("https://discord.com/api/v10/users/$BOT_ID");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bot $BOT_TOKEN"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
$status = "";
if (isset($data['message'])) {
    $status = "❌ Token Invalid — " . htmlspecialchars($data['message']);
} else {
    $status = "✅ Token Works — Logged in as " . htmlspecialchars($data['username']) . "#" . htmlspecialchars($data['discriminator']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Backend Health</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #23272A, #2C2F33);
        color: white;
        text-align: center;
        padding: 50px;
    }
    .status {
        background: rgba(255,255,255,0.1);
        padding: 20px;
        border-radius: 8px;
        display: inline-block;
    }
</style>
</head>
<body>
    <h1>Backend Health</h1>
    <div class="status">
        <p><?= $status ?></p>
    </div>
</body>
</html>
