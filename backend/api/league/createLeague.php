<?php
require __DIR__ . '/../../DB/connect.php';
require __DIR__ . '/../../MODEL/league.php';
header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->name) || empty($data->id_trustee)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();
$league = new League($conn);

if ($league->createLeague($data->name, $data->id_trustee)) {
    
    echo json_encode(["message" => "Registration completed", "response" => true]);
} else {
    echo json_encode(["message" => "Registration failed successfully ", "response" => false]);
}
?>