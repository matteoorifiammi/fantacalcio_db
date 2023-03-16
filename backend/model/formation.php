<?php
class Formation
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createformation($id_squad, $id_league, $id_player)
    {
        $sql = "INSERT INTO `formation` (id_squad, id_league, id_player)
                VALUES (?, ?, ?);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iii', $id_squad, $id_league, $id_player);
        return $stmt->execute();
    }

    public function getformation($id)
    {
        $sql = "SELECT * FROM `formation` WHERE id = ". $this->conn->real_escape_string($id) .";";

        return $this->conn->query($sql);
    }

    public function getArchiveformation()
    {
        $sql = "SELECT * FROM `formation`";

        return $this->conn->query($sql);
    }
}
?>