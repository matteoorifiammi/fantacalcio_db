<?php
require __DIR__ . '/../../DB/connect.php';
require __DIR__ . '/../../MODEL/formation.php';
header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->id_squad) || empty($data->id_league) || empty($data->id_player)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();
$formation = new formation($conn);

if ($formation->createformation($data->id_squad, $data->id_league, $data->id_player)) {
    
    echo json_encode(["message" => "Registration completed", "response" => true]);
} else {
    echo json_encode(["message" => "Registration failed successfully ", "response" => false]);
}
?>