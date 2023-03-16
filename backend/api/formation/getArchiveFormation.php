<?php
require("../../DB/connect.php");
require("../../MODEL/formation.php");

header("Content-type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->connect();
$formation = new formation($conn);

$result = $formation->getArchiveformation();
if ($result->num_rows > 0)
{
    $formation = array();
    while($record = $result->fetch_assoc())
    {
        $formation[] = $record;
    }

    http_response_code(200);
    echo json_encode($formation, JSON_PRETTY_PRINT);
}
else
{
    http_response_code(400);
    echo json_encode(["response" => false, "message" => "no record"]);
}

die();