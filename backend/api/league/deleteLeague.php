<?php
require("../../DB/connect.php");
require("../../MODEL/league.php");

header("Content-type: application/json; charset=UTF-8");

if (!isset($_GET['id']) || empty($id = $_GET['id']))
{
    http_response_code(400);
    echo json_encode(["Message" => "Id required"]);
    die();
}

$db = new Database();
$conn = $db->connect();
$league = new League($conn);

if ($league->deleteLeague($id))
{
    http_response_code(200);
    echo json_encode(["response" => true, "message" => "League deleted"]);
}
else
{
    http_response_code(400);
    echo json_encode(["response" => false, "message" => "no record"]);
}

die();
?>