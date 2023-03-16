<?php
require __DIR__ . '/../../DB/connect.php';
require __DIR__ . '/../../MODEL/player.php';
header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->surname) || empty($data->role)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();
$player = new Player($conn);

if ($player->createPlayer($data->surname, $data->role)) {
    
    echo json_encode(["message" => "Registration completed", "response" => true]);
} else {
    echo json_encode(["message" => "Registration failed successfully ", "response" => false]);
}
?>