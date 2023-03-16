<?php
require __DIR__ . '/../../DB/connect.php';
require __DIR__ . '/../../MODEL/squadLeague.php';
header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->id_squad) || empty($data->id_league)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();
$squad_league = new squadLeague($conn);

if ($squad_league->createSquadLeague($data->id_squad, $data->id_league)) {
    
    echo json_encode(["message" => "Registration completed", "response" => true]);
} else {
    echo json_encode(["message" => "Registration failed successfully ", "response" => false]);
}
?>