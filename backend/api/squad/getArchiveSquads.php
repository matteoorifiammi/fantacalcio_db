<?php
require("../../DB/connect.php");
require("../../MODEL/squad.php");

header("Content-type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->connect();
$squad = new Squad($conn);

$result = $squad->getArchiveSquads();
if ($result->num_rows > 0)
{
    $squads = array();
    while($record = $result->fetch_assoc())
    {
        $squads[] = $record;
    }

    http_response_code(200);
    echo json_encode($squads, JSON_PRETTY_PRINT);
}
else
{
    http_response_code(400);
    echo json_encode(["response" => false, "message" => "no record"]);
}

die();