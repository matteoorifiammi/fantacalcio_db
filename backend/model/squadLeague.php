<?php
class squadLeague
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createSquadLeague($id_squad, $id_league)
    {
        $sql = "INSERT INTO `squad_league` (id_squad, id_league)
                VALUES (?, ?);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $id_squad, $id_league);
        return $stmt->execute();
    }

    public function getSquadLeague($id)
    {
        $sql = "SELECT * FROM `squad_league` WHERE id = ". $this->conn->real_escape_string($id) .";";

        return $this->conn->query($sql);
    }

    public function getArchiveSquadLeagueByLeagueId($id)
    {
        $sql = "SELECT * FROM `squad_league`";

        return $this->conn->query($sql);
    }
}
?>