<?php
class Matchh
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createMatch($number_match, $id_squad, $score, $id_league)
    {
        $sql = "INSERT INTO `match` (number_match, id_squad, score, id_league)
                VALUES (?, ?, ?, ?);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iiii', $number_match, $id_squad, $score, $id_league);
        return $stmt->execute();
    }

    public function getMatch($id)
    {
        $sql = "SELECT * FROM `match` WHERE id = ". $this->conn->real_escape_string($id) .";";

        return $this->conn->query($sql);
    }

    public function getArchiveMatch()
    {
        $sql = "SELECT * FROM `match`";

        return $this->conn->query($sql);
    }
}
?>