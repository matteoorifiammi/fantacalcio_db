<?php
class League
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createLeague($name, $id_trustee)
    {
        $sql = "INSERT INTO `league` (name, id_trustee)
                VALUES (?, ?);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $name, $id_trustee);
        return $stmt->execute();
    }

    public function getLeague($id)
    {
        $sql = "SELECT * FROM `league` WHERE id = ". $this->conn->real_escape_string($id) .";";

        return $this->conn->query($sql);
    }

    public function getArchiveLeague()
    {
        $sql = "SELECT * FROM `league`";

        return $this->conn->query($sql);
    }

    public function getActiveLeague()
    {
        $sql = "SELECT * FROM `league` WHERE status = 0";

        return $this->conn->query($sql);
    }
 
    public function deleteLeague($id)
    {
        $sql = "UPDATE `league`
                SET status = 1
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        if ($stmt->execute() && $stmt->affected_rows > 0)
            return $stmt;
        else
            return "";
    }
}
?>