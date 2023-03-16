<?php
class Player
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createPlayer($surname, $role)
    {
        $sql = "INSERT INTO `player` (surname, role)
                VALUES (?, ?);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $surname, $role);
        return $stmt->execute();
    }

    public function getPlayer($id)
    {
        $sql = "SELECT * FROM `player` WHERE id = ". $this->conn->real_escape_string($id) .";";

        return $this->conn->query($sql);
    }

    public function getArchivePlayer()
    {
        $sql = "SELECT * FROM `player`";

        return $this->conn->query($sql);
    }
}
?>