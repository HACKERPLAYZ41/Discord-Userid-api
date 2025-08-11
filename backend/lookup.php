<?php
header('Content-Type: application/json');

// Config
$api_url = "http://103.180.237.112:25003/user/"; // Bot's public IP + Port

$user_id = $_GET['id'] ?? '';
if (!$user_id) {
    echo json_encode(["error" => "No user ID provided"]);
    exit;
}

$response = file_get_contents($api_url . urlencode($user_id));
if ($response === FALSE) {
    echo json_encode(["error" => "Failed to contact bot API"]);
    exit;
}

echo $response;
