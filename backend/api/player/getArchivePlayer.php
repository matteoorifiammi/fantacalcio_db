<?php
require("../../DB/connect.php");
require("../../MODEL/player.php");

header("Content-type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->connect();
$player = new Player($conn);

$result = $player->getArchivePlayer();
if ($result->num_rows > 0)
{
    $player = array();
    while($record = $result->fetch_assoc())
    {
        $player[] = $record;
    }

    http_response_code(200);
    echo json_encode($player, JSON_PRETTY_PRINT);
}
else
{
    http_response_code(400);
    echo json_encode(["response" => false, "message" => "no record"]);
}

die();