<?php
require __DIR__ . '/../../DB/connect.php';
require __DIR__ . '/../../MODEL/match.php';
header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));
print_r($data);

if (empty($data->number_match) || empty($data->id_squad) || empty($data->score) || empty($data->id_league)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();
$match = new Matchh($conn);

if ($match->createMatch($data->number_match, $data->id_squad, $data->score, $data->id_league)) {
    
    echo json_encode(["message" => "Registration completed", "response" => true]);
} else {
    echo json_encode(["message" => "Registration failed successfully ", "response" => false]);
}
?>


