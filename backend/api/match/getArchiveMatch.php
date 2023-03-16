<?php
require("../../DB/connect.php");
require("../../MODEL/match.php");

header("Content-type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->connect();
$match = new Matchh($conn);

$result = $match->getArchiveMatch();
if ($result->num_rows > 0)
{
    $match = array();
    while($record = $result->fetch_assoc())
    {
        $match[] = $record;
    }

    http_response_code(200);
    echo json_encode($match, JSON_PRETTY_PRINT);
}
else
{
    http_response_code(400);
    echo json_encode(["response" => false, "message" => "no record"]);
}

die();