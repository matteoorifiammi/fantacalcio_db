<?php
require("../../DB/connect.php");
require("../../MODEL/league.php");

header("Content-type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->connect();
$league = new League($conn);

$result = $league->getActiveLeague();
if ($result->num_rows > 0)
{
    $leagues = array();
    while($record = $result->fetch_assoc())
    {
        $leagues[] = $record;
    }

    http_response_code(200);
    echo json_encode($leagues, JSON_PRETTY_PRINT);
}
else
{
    http_response_code(400);
    echo json_encode(["response" => false, "message" => "no record"]);
}

die();
