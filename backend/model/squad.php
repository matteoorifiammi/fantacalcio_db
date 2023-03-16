<?php
class Squad
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createSquad($name, $id_user)
    {
        $sql = "INSERT INTO `squad` (name,id_user)
                VALUES (?, ?);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $name, $id_user);
        return $stmt->execute();
    }

    
    public function getSquad($id)
    {
        $sql = "SELECT * FROM `squad` WHERE id = ". $this->conn->real_escape_string($id) .";";

        return $this->conn->query($sql);
    }

    public function getArchiveSquads()
    {
        $sql = "SELECT * FROM `squad`";

        return $this->conn->query($sql);
    }
}
?>